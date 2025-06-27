<!-- This assumes your logo files are in the public/images/ folder -->

<!-- For Light Mode -->
<img src="{{ asset('images/logo-color.png') }}" {{ $attributes->merge(['class' => 'dark:hidden']) }} alt="Your Company Logo">

<!-- For Dark Mode -->
<img src="{{ asset('images/logo-white.png') }}" {{ $attributes->merge(['class' => 'hidden dark:block']) }} alt="Your Company Logo">