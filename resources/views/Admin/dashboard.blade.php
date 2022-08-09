<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="row">
           <div class="col-md-6 col-md-offset-3">
                  <h4>Dashboard</h4><hr>
                  <table class="table table-hover">
                     <thead>
                       <th>Name</th>
                       <th>Email</th>
                       <th><a href="{{route('auth.logout')}}">Logout</a></th>
                     </thead>
                     <tbody>         
                      <tr>
                        <td>{{$LoggedUser['name']}}</td>
                        <td>{{$LoggedUser['email']}}</td> 
                      </tr>     
                    </tbody>
                  </table>
           </div>
        </div>
   </div>
</body>
</html>