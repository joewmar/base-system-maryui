@section('title') Schedule @endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.7.0/build/vanilla-calendar.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.7.0/build/themes/light.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.7.0/build/themes/dark.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.7.0/build/vanilla-calendar.min.js" defer></script>

@endsection
<div>
    <x-calendar :events="$events" />
</div>