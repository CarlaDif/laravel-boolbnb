Hai un nuovo messaggio:

Da: {{ $messaggio->name }}
Email: {{ $messaggio->email }}
<br>
{{ $messaggio->message }}
<a href="mailto:{{ $messaggio->email }}">Rispondi a {{ $messaggio->name }}</a>
