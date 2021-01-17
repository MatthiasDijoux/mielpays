<?php

namespace App\Http\Controllers;

use App\AdresseModel;
use App\Http\Resources\OrderResource;
use App\Mail\Contact;
use App\OrderModel;
use App\ProductModel;
use App\StatusModel;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    function create(Request $request)
    {
        $orders = Validator::make(
            $request->input(),
            [
                'order' => 'required',
                'adresseLivraison' => 'required',
                'adresseFacturation' => 'required',
            ]
        )->validate();
        $prixTotal = [];
        $i = 0;
        foreach ($orders['order'] as $order) {
            $i = $i + 1;
            $prixTotal[$i] = $order['price'] * $order['quantity'];
        }
        $prixTotal = array_sum($prixTotal);
        $user = $request->user();
        DB::beginTransaction();

        try {
            if ($user) {
                $createOrder = new OrderModel();
                $user = $this->addUserToOrder($user, $createOrder);
                $this->addAdresseLivraison($orders['adresseLivraison'], $createOrder, $user);
                $this->addAdresseFacturation($orders['adresseFacturation'], $createOrder, $user);
                $createOrder->nom = $orders['adresseLivraison']['nom'];
                $createOrder->prenom = $orders['adresseLivraison']['prenom'];
                $createOrder->save();
                $this->addProductsToOrder($orders['order'], $createOrder);
                Mail::to($user['email'])
                    ->send(new Contact([
                        'nom' => $user->username,
                        'order' => $createOrder,
                        'adresse_livraison' => $orders['adresseLivraison'],
                        'adresse_facturation' => $orders['adresseFacturation'],
                        'prix_total' => $prixTotal,
                    ]));
            }
        } catch (Exception $e) {
            Db::rollBack();
            return $e->getMessage();
        }
        DB::commit();
        return new OrderResource($createOrder);
    }

    function addAdresseLivraison($adresse, &$order, $user)
    {
        $adresse = $this->createAdresse($adresse, $user);
        $order->adresseLivraison()->associate($adresse);
    }
    function addAdresseFacturation($adresse, &$order, $user)
    {
        $adresse = $this->createAdresse($adresse, $user);
        $order->adresseFacturation()->associate($adresse);
    }

    function createAdresse($_adresse, $user)
    {
        $adresse =  new AdresseModel();
        $adresse->pays = $_adresse['pays'];
        $adresse->ville = $_adresse['ville'];
        $adresse->code_postal = $_adresse['codePostal'];
        $adresse->adresse = $_adresse['pays'];
        $adresse->user()->associate($user);
        $adresse->save();
        return $adresse;
    }
    function addUserToOrder($user, &$order)
    {
        $user = User::where('id', '=', $user->id)->first();
        if (!$user) {
            throw new Exception('Pas connecté');
        }
        $order->user()->associate($user);
        return $user;
    }
    function addProductsToOrder($basket, &$order)
    {
        foreach ($basket as $_order) {
            $quantity = $_order['quantity'];
            $idProduct = $_order['id'];
            $product = ProductModel::find($idProduct);
            if (!$product) {
                throw new Exception('Produits incorrects');
            }
            $order->products()->attach($product, ['quantity' => $quantity]);
        }
    }
    function paiement(Request $request, $id)
    {
        $paiement = Validator::make(
            $request->input(),
            [
                'id' => 'required',
                'prix' => 'required',
            ]
        )->validate();
        $order = OrderModel::find($id);
        $user = $request->user();
        $stripe = new Stripe('sk_test_51IAEzpEnkCEipEKype3pWr2JRFf8nKVL141Ylp4h8MwIfcy0uAsZ3Af2colxBHAXhz8T28LKpAWrohuDhimLfLJt00GHl9vveq');
        try {
            $charge = $stripe::charges()->create([
                'amount' => $paiement['prix'],
                'currency' => 'EUR',
                'source' => $paiement['id'],
                'description' => 'Achat de produit sur Mielpays.re',
                'receipt_email' => $user->email,
            ]);
            $status = StatusModel::with(['orders'])->find(2);
            $order->orderStatus()->associate($status);
            $order->save();
            return ['paiement' => $charge, 'status' => $order];
        } catch (Exception $e) {
            $status = StatusModel::with(['orders'])->find(1);
            $order->orderStatus()->associate($status);
            $order->save();
            return ['error' => $e, 'status' => $order];
        }
    }

    function getPdf(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        )->validate();

        $commande = OrderModel::with(['Products'])->where('id', $validator['id'])->first();
        $formatCommande = new OrderResource($commande);
        $pdf = PDF::loadView('pdf.facture', compact("formatCommande"));
        return $pdf->stream();
    }
}
