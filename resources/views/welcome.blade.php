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

         <div class="col-md-6 col-lg-4">
           <div class="card h-100 shadow-sm">
             <img src="https://source.unsplash.com/600x400/?nature,water"
                  class="card-img-top" alt="Nature" loading="lazy">
             <div class="card-body">
               <h5 class="card-title">The Beauty of Nature</h5>
               <p class="card-text text-muted">
                 Discover the healing power of natural environments on well-being.
               </p>
               <a href="#" class="btn btn-sm btn-outline-danger">Read more →</a>
             </div>
           </div>
         </div>

         <div class="col-md-6 col-lg-4">
           <div class="card h-100 shadow-sm">
             <img src="https://source.unsplash.com/600x400/?technology,code"
                  class="card-img-top" alt="Technology" loading="lazy">
             <div class="card-body">
               <h5 class="card-title">Top 10 Laravel Tips</h5>
               <p class="card-text text-muted">
                 Boost your productivity with these essential Laravel tips.
               </p>
               <a href="#" class="btn btn-sm btn-outline-danger">Read more →</a>
             </div>
             </div>
         </div>

         <div class="col-md-6 col-lg-4">
           <div class="card h-100 shadow-sm">
             <img src="https://source.unsplash.com/600x400/?writing,notebook"
                  class="card-img-top" alt="Writing" loading="lazy">
             <div class="card-body">
               <h5 class="card-title">Writing as Therapy</h5>
               <p class="card-text text-muted">
                 Explore how writing can enhance mental clarity and health.
               </p>
               <a href="#" class="btn btn-sm btn-outline-danger">Read more →</a>
             </div>
           </div>
         </div>

       </div>
     </div>
   </main>

   <footer class="bg-white border-top py-4 text-center text-muted">
     &copy; 2025 <strong>BlogNest</strong>. All rights reserved.
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>
