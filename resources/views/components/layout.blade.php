<!doctype html>
<head>
<title>Laravel From Scratch Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- @vite('resources/css/app.css') --}}
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    html{
        scroll-behavior: smooth;
    }
.clamp{
	display: -webkit-box;
	-webkit-box-orient: vertical;
	overflow:hidden;
}

.clamp.one-line{
	-webkit-line-clamp: 1;
}
</style>
</head>
<body style="font-family: Open Sans, sans-serif">
		<section class="px-6 py-8">
				<nav class="md:flex md:items-center md:justify-between">
						<div>
								<a href="/">
										<img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
								</a>
						</div>

						<div class="mt-8 md:mt-0 flex items-center">
                            @auth
                            <span class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}</span>

                            <form action="/logout" method="post" class="text-xs font-semibold text-blue-500 ml-6">
                                @csrf

                                <button type="submit">Log Out</button>

                            </form>

                            <a href="/admin/posts/create" class="text-xs font-semibold text-blue-500 ml-6">Create Post</a>

                            @else
								<a href="/register" class="text-xs font-bold uppercase">Register</a>
								<a href="/login" class="text-xs font-bold uppercase ml-6">Login</a>
                            @endguest
								<a href="#newsletter" class="ml-3 rounded-full bg-blue-500 px-5 py-3 text-xs font-semibold uppercase text-white">
										Subscribe for Updates
								</a>
						</div>
				</nav>

				{{ $slot }}

				<footer id="newsletter" class="mt-16 rounded-xl border border-black border-opacity-5 bg-gray-100 px-10 py-16 text-center">
						<img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
						<h5 class="text-3xl">Stay in touch with the latest posts</h5>
						<p class="mt-3 text-sm">Promise to keep the inbox clean. No bugs.</p>

						<div class="mt-10">
								<div class="relative mx-auto inline-block rounded-full lg:bg-gray-200">

										<form method="POST" action="/newsletter" class="text-sm lg:flex">
                                            @csrf
												<div class="flex items-center lg:px-5 lg:py-3">
														<label for="email" class="hidden lg:inline-block">
																<img src="/images/mailbox-icon.svg" alt="mailbox letter">
														</label>

                                                        <div>
                                                            <input name="email" id="email" type="text" placeholder="Your email address"
                                                            class="py-2 pl-4 focus-within:outline-none lg:bg-transparent lg:py-0">

                                                            @error('email')
                                                                <span class="text-xs text-red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
												</div>

												<button type="submit"
														class="mt-4 rounded-full bg-blue-500 px-8 py-3 text-xs font-semibold uppercase text-white transition-colors duration-300 hover:bg-blue-600 lg:ml-3 lg:mt-0">
														Subscribe
												</button>
										</form>
								</div>
						</div>
				</footer>
		</section>

        <x-flash />
</body>
