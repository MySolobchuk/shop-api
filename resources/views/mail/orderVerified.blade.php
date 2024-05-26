<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<div style="font-size: 20px;">
    <table width="100%">
        <tr>
            <td colspan="3" style="text-align: center">
                <a href="https://polandgroups.pl/shop/">
                    <img src="https://polandgroups.pl/shop/img/logo.9332798f.png" alt="logo">
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div>Dzień dobry {{ $order->user_information['fullname'] }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div>Twój zakup</div>
                <div>z dnia {{ date('d.m.Y', strtotime('now')) }}</div>
            </td>
        </tr>
        <tr>
            @foreach($order->items as $item)
            <td width="60%">{{$item->product->name}}</td>
            @endforeach
            <td width="10%">--</td>
            <td width="30">{{$order->getPrice()}} zł</td>
        </tr>
        <tr>
            <td>Kurier DPD, <strong>(Ulica dom klienta) Zagrodowa 3</strong></td>
            <td>--</td>
            <td>
                <div>{{$order->getBoxPrice()}} zł</div>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <div>__________</div>
                <div>RAZEM {{$order->getPrice() + $order->getBoxPrice()}} zł</div>
            </td>
        </tr>
        <tr>
            <td colspan="3">Przewidywany czas dostawy {{ date('d.m.Y', strtotime("+3 day")) }} u Ciebie</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 50px;">
        <tr>
            <td width="60%">Adres e-mail</td>
            <td width="10%">--</td>
            <td width="30">{{$order->user_information['email']}}</td>
        </tr>
        <tr>
            <td>Firma</td>
            <td>--</td>
            <td>{{$order->deliver_information['business']}}</td>
        </tr>
        <tr>
            <td>NIP UE</td>
            <td>--</td>
            <td>{{$order->deliver_information['nip_ue']}}</td>
        </tr>
        <tr>
            <td>Adress</td>
            <td>--</td>
            <td>{{$order->deliver_information['address']}}</td>
        </tr>
        <tr>
            <td>Kod pocztowy</td>
            <td>--</td>
            <td>{{$order->deliver_information['zip_code']}}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>--</td>
            <td>{{$order->deliver_information['country']}}</td>
        </tr>
        <tr>
            <td>Miasto</td>
            <td>--</td>
            <td>{{$order->deliver_information['city']}}</td>
        </tr>
        <tr>
            <td>Telefoniczny numer kontaktowy</td>
            <td>--</td>
            <td>{{$order->deliver_information['phone']}}</td>
        </tr>
    </table>
    @if (!empty($order->alt_deliver_information))
    <table style="margin-top: 50px" width="100%">
        <tr>
            <td width="60%">Proszę użyć innego adresu rozliczeniowego</td>
            <td width="10%">--</td>
            <td width="30%"></td>
        </tr>
        <tr>
            <td>Imię</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['fullname']}}</td>
        </tr>
        <tr>
            <td>Firma</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['business']}}</td>
        </tr>
        <tr>
            <td>NIP UE</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['nip_ue']}}</td>
        </tr>
        <tr>
            <td>Adress</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['address']}}</td>
        </tr>
        <tr>
            <td>Kod pocztowy</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['zip_code']}}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['country']}}</td>
        </tr>
        <tr>
            <td>Miasto</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['city']}}</td>
        </tr>
        <tr>
            <td>Telefoniczny numer kontaktowy</td>
            <td>--</td>
            <td width="30">{{$order->alt_deliver_information['phone']}}</td>
        </tr>
    </table>
    @endif
</div>


</body>
</html>
