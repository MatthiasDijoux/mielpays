<!DOCTYPE html>
<html lang="fr">
<head>
    <style>
        .fontStyle{
            font-size: 13px;
        }
        .fontBold {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
        }

        .tableformatCommande {
            table-layout:fixed;
            word-wrap: break-word; 
            overflow-wrap: break-word;
        }
    </style>
</head>
<body>

    <div>
        <table>
            <tr>
                <td class="fontStyle fontBold"> Nom : {{ $formatCommande['products'][0]->name }} </td>
                <td class="fontStyle fontBold"> Prix : {{ $formatCommande['products'][0]->prix }} </td>
                <td class="fontStyle fontBold"> Quantité : {{ $formatCommande['products'][0]->pivot->quantity }} </td>
            </tr>
        </table>

        <table style="margin-left: 500px !important; margin-top: -100px !important;">
            <tr>
                <td class="fontStyle fontBold"> Commande n°{{ $formatCommande->id }} </td>
            </tr>
        </table>
    </div>

      <div style="margin-top: 30px; margin-left: 500px;">
        <table>
            <tr>
                <td class="fontStyle fontBold"> {{ $formatCommande->user->name }} </td>
            </tr>
            <tr>
                <td class="fontStyle">{{ $formatCommande->adresse_livraison }}, {{ $formatCommande->adresse_livraison }}</td>
            </tr>
            <tr>
                <td class="fontStyle">E-mail : {{ $formatCommande->user->email }}</td>
            </tr>
        </table>
    </div>

    <table style="margin-top: 45px !important; margin-left: 10px; width: 100%; padding: 0;" class="fontStyle tableformatCommande">
        <thead>
            <tr style="padding: 0;">
                <th style="border: 1px solid black;"> Produit </th>
                <th style="border: 1px solid black;"> Quantité </th>
                <th style="border: 1px solid black;"> Prix </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($formatCommande['products'] as $commandesProducts)
        <tr style="outline: 0;">
            <td style="border: 1px solid black; padding-left: 5px;"> {{ $formatCommande['products'][0]->name }} </td> 
            <td style="border: 1px solid black; padding-left: 5px;"> {{ $formatCommande['products'][0]->prix }}</td> 
            <td style="border: 1px solid black; padding-left: 5px;"> {{ $formatCommande['products'][0]->pivot->quantity }} </td> 
           
        @endforeach
        </tbody>
    </table>

</body>
</html>