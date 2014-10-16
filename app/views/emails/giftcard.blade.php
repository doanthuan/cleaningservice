<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Dear {{$giftcard->to_name}}</p>
<p>
    {{$giftcard->message}}
</p>
<p>
    <b>From: {{$giftcard->from_name}}</b><br/>
    <b>Code: {{$giftcard->discount_code}}</b><br/>
    <b>Gift Amount: ${{$giftcard->gift_amount}}</b><br/>
</p>
<p>Somebody must really find you special to buy a gift card to MaidSavvy :). Please go to <a href="http://maidsavvy.com/booking/">MaidSavvy.com</a> to redeem your gift card.</p>
</body>
</html>
