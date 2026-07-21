{{--
    Resolves <x-doctor-layout title="..."> used by every doctor.* blade file.
    It just hands off to the real layout markup at doctor/layouts/app.blade.php,
    which already expects $slot (and optional $title).
--}}
@include('doctor.layouts.app')
