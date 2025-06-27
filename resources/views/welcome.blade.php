 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>BlogNest</title>
   <meta name="description"
         content="BlogNest – Your daily dose of fresh stories, ideas, and insights." />

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
         rel="stylesheet">
 </head>

 <body class="bg-light">

   <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
     <div class="container">
       <a class="navbar-brand fw-bold text-dark" href="/">BlogNest</a>
       <div>
         <a href="/login"    class="btn btn-outline-secondary me-2">Login</a>
         <a href="/register" class="btn btn-danger text-white">Register</a>
       </div>
     </div>
   </nav>

   <header class="bg-white py-5 text-center border-bottom">
     <div class="container">
       <h1 class="display-5 fw-bold">Welcome to BlogNest</h1>
       <p class="lead text-muted">Your daily dose of fresh stories, ideas, and insights.</p>
       </div>
   </header>

   <main class="py-5">
     <div class="container">
       <h2 class="mb-4 text-center">Latest Posts</h2>
       <div class="row g-4">
         @foreach ($posts as $post)
           <div class="col-md-6 col-lg-4">
             <div class="card h-100 shadow-sm border-0">
               <div class="card-header text-white" style="background-color: #a2d5f2;">
                 <h5 class="card-title mb-0">{{ $post->title }}</h5>
               </div>
               <div class="card-body" style="background-color: #f0f8ff;">
                 <p class="card-text text-muted">
                   {{ \Illuminate\Support\Str::limit($post->content, 20) }}
                 </p>
                 <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">Read more →</a>
               </div>
             </div>
           </div>

         @endforeach
       </div>
     </div>
   </main>


    <footer class="bg-white border-top py-4 text-center text-muted fixed-bottom">
     &copy; 2025 <strong>BlogNest</strong>. All rights reserved.
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>
