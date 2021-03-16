import { EventBus } from '../eventBus';
import { clientService } from './clientService';
export const basketService = {
    add,
    getBasket,
    basketSize,
    replaceQuantity,
    sendOrder,
}

function add(product, quantity) {
    let basket = getBasket()
    let snackbar = [];
    let _quantity = 0;
    //Vérifie que l'objet basket contenant le produit existe ou non
    //si non, on définie l'objet   
    if (!_.hasIn(basket, buildKey(product))) {
        basket[buildKey(product)] = {
            id: product.id,
            name: product.name,
            price: product.prix
        }
        _quantity = parseInt(quantity);
    }
    //si  oui, on incrémente la quantité actuelle
    else {
        _quantity = basket[buildKey(product)].quantity + parseInt(quantity)
    }
    if (_quantity > product.quantite) {
        _quantity = product.quantite
    }
    if (_quantity > 10) {
        _quantity = 10
    }
    snackbar['msg'] = _quantity + ' Articles ajouté au panier'

    basket[buildKey(product)]['quantity'] = _quantity
    //on appelle la fonction store pour l'ajouté au local storage
    storeBasket(basket)

}
function getBasket() {
    let basket = localStorage.getItem("currentBasket");
    if (!basket) {
        basket = {}
    }
    else {
        basket = JSON.parse(basket)
    }
    return basket
}
function storeBasket(basket) {
    localStorage.setItem("currentBasket", JSON.stringify(basket))
    EventBus.$emit('basket', basket)
    emitProductsSize(basket)
}
function buildKey(product) {
    return 'product_' + product.id
}
function basketSize() {
    let basket = getBasket()
    basket = _.toPairsIn(basket).length
    return basket
}
function emitProductsSize(basket) {
    EventBus.$emit('basketSize', _.toPairsIn(basket).length)
}
function replaceQuantity(product) {
    let basket = getBasket()
    if (_.hasIn(basket, buildKey(product))) {
        basket[buildKey(product)] = product
        if ((basket[buildKey(product)].quantity) == 0) {
            _.unset(basket, buildKey(product))
        }
    }
    else {
        throw 'Err'
    }
    storeBasket(basket)
}
function sendOrder(order) {
    let basket = getBasket();
    let ordersList = [];
    for (let i in basket) {
        let obj = {}
        obj['id'] = basket[i].id
        obj['quantity'] = basket[i].quantity
        ordersList.push(obj)
    }
    return clientService.post('/api/orders', {
        order: order.orderList,
        adresseLivraison: order.adresseLivraison,
        adresseFacturation: order.adresseFacturation,
    })
}