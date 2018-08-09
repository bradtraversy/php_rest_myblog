

$(document).ready(function(){
    $('#postMessage').click(function(){
        // e.preventDefault();

        var url = $('form').serialize();

        function getUrlVars(url) {
            var hash;
            var myJson = {};
            var hashes = url.slice(url.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                myJson[hash[0]] = hash[1];
            }
            return JSON.stringify(myJson);
        }

        var pp = getUrlVars(url);
        // alert(pp);

        $.ajax({
            type:"POST",
            url: "/Work folders/OOP php/RESTFUL traversy/php_rest_myblog/api/post/create.php",
            data: pp,
            ContentType:"application/json",

            success:function(){
                alert('successfully posted');
            },
            error:function(){
                alert('Could not be posted');
            }

        });
    });
});
//   document.addEventListener('DOMContentLoaded',function(){
//   document.getElementById('postMessage').onclick=function(e){

//           e.preventDefault();
//           var chapman = {
//                           "title":"Let's do this",
//                           "body":"boomer",
//                           "author":"sai kosuri",
//                           "category_id":"4"
//                         }

//           var bon = JSON.stringify(chapman);
//           req=new XMLHttpRequest();
//           req.open("POST", '/Work folders/OOP php/RESTFUL traversy/php_rest_myblog/api/post/create.php', true);
//           req.setRequestHeader('Content-Type','application/json');
//           req.onreadystatechange=function(){

//             if(req.readyState==4 && req.status==200){
//               alert('Submission was successful');
//             }else{
//               alert('Could not post data');
//             }

//           };
//           req.send(bon);           
//       }

//   });     


  document.addEventListener('DOMContentLoaded',function(){
  document.getElementById('getMessage').onclick=function(){
          // Add your code below this line
       req=new XMLHttpRequest();
       req.open("GET", '/Work folders/OOP php/RESTFUL traversy/php_rest_myblog/api/post/read.php',true);
       req.send();
      
       req.onload=function(){
       var json=JSON.parse(req.responseText);

       var son = json.filter(function(val) {
              return (val.id >= 11);  
          });

      var html = "";

      son.forEach(function(val) {
          var keys = Object.keys(val);

          html += "<div class = 'cat'>";
              keys.forEach(function(key) {
              html += "<strong>" + key + "</strong>: " + val[key] + "<br>";
              });
          html += "</div><br>";
      });

      document.getElementsByClassName('message')[0].innerHTML=html;         
      // document.getElementsByClassName('message')[0].innerHTML=JSON.stringify(json);
      };
    };
  });
  
