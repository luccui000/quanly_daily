<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Index</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> 
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <script
            src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script> 
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
        @livewireStyles
        <style>
            .truncate-2-lines {
                max-height: 3.6em; 
                line-height: 1.8em;
                display: block;
                text-overflow: ellipsis;
                word-wrap: break-word;
                overflow: hidden;
            }
            .dropdown:hover .dropdown-menu {
                display: block;
            }
        </style>
    </head>
    <body>  
        <div class="mx-auto"> 
            @yield('content')
        </div> 
        @livewireScripts  
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
        <script>  
            window.addEventListener('swal.modal', event => { 
                Swal.fire({
                    title: event.detail.title,   
                    content: event.detail.content ?? "",   
                    icon: event.detail.type,   
                }) 
            }) 
        </script>
    </body>
</html>