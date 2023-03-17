<x-mail::message>

Zarezerwowałeś pokój: {{$roomNum}} <br>
Okres rezerwacji: {{$arrDate}} --- {{$depDate}} <br>

Kliknij poniżej aby zobaczyć swoją rezerwację

<x-mail::button :url="$url" color="success">
    Twoja rezerwacja
</x-mail::button>

</x-mail::message>