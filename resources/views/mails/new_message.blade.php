Hai un nuovo messaggio da {{ $messaggio->name }}
<br>
Email: {{ $messaggio->email }}
<br>
<p>Testo:</p>
{{ $messaggio->message }}
<br>
<a href="mailto:{{ $messaggio->email }}">Rispondi a {{ $messaggio->name }}</a>
