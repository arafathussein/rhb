<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add icon library -->
    <title>Github Search</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

      <style>
        * {
          box-sizing: border-box;
        }

        #myInput {
          background-image: url('/css/searchicon.png');
          background-position: 10px 12px;
          background-repeat: no-repeat;
          width: 100%;
          font-size: 16px;
          padding: 12px 20px 12px 40px;
          border: 1px solid #ddd;
          margin-bottom: 12px;
        }

        #myUL {
          list-style-type: none;
          padding: 0;
          margin: 0;
        }

        #myUL li a {
          border: 1px solid #ddd;
          margin-top: -1px; /* Prevent double borders */
          background-color: #f6f6f6;
          padding: 12px;
          text-decoration: none;
          font-size: 18px;
          color: black;
          display: block
        }

        #myUL li a:hover:not(.header) {
          background-color: #eee;
        }
    </style>
  </head>
  <body>
    <div style="width:80%; margin:auto">
    <form  style="max-width:500px;margin:auto" method="POST" onsubmit="return validateForm()"  > 
      <h2>Github Search</h2>
      <div class="input-container">
        <input class="input-field" type="text" placeholder="Search" name="srcval"  id ="srcval" >
        <i class="fa fa-search icon"></i>
      </div>
    </form>
    <pre id="preseg"> </pre>
    <div class="list-group" id="searchList" name="searchList"></div>
  </body>

  <script>
    function validateForm() { 
        var s = $('#srcval').val().trim();
        var api_url = "https://api.github.com/search/repositories?per_page=10&q="+s

        $.ajax({url: api_url,
          success: function(returndata){
          $('#searchList').html('')
          $('#preseg').html( '<h5 class="mb-1 lead" >' + returndata.total_count + '  repository results </h5> ')
        
          $.each(returndata.items, function(index, item) { 
            var fullName = item.full_name
            var language = item.language
            var stargazers_count = item.stargazers_count

            var desc = item.description
            var stars = item.stargazers_count
            var updatedAt = item.updated_at

            var li = '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">'
            li += '<div class="d-flex w-100 justify-content-between">'
            li += '<h5 class="mb-1 lead" >'+ fullName +'</h5>'
            li += '<small style="float:right; margin-left: 30px  "><i class="fa fa-star icon"></i>  '+ stargazers_count +'</small>'
            li += '<small style="float:right; margin-left: 30px  "><i class="fa fa-circle icon"></i>  '+ language +'</small>'
            li += '</div>'
            li +=' <p class="mb-1">'+ desc +'</p>'
            li += '<small>'+ updatedAt +'</small>'
            li += '</a>'

            $('#searchList').append(li)
          })
        }});
        return false;
      }
    </script>  
</html>