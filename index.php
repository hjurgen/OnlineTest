<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Test</title>
    <link href="style.css?v=2" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  </head>
  <body>
    <nav class="navtop">
      <div>
        <h1>Online Test</h1>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
      </div>
    </nav>

    <div id="container">
    <div id="output"></div>
    <div id="selAnswers"></div>
    </div>
    <input onclick="change()" type="button" id="btn" value="Start test" class="button123"></input>
    <form action="ajax.php" method="post" id="postform">
    <input type="text" style="display:none" id="correct" value="0" name="correct" />
    <input type="submit" id="submitbtn" style="display: none" value="Submit" class="button123" />
    </form>
    <script>
    var btn = document.getElementById ('btn');
    var submit = document.getElementById ('submitbtn');
    var correctInput = document.getElementById('correct');



    function change()
    {
      var elem = document.getElementById("btn");
         if (elem.value=="Start test") elem.value = "Next question";
         else elem.value = "Next question";
     }


      btn.addEventListener('click', nextItem)
      var answers = {
        'correct':0
      }


      var counter = 0;
      var output = document.getElementById('output');
      var selAnswer = document.getElementById('selAnswers')

      function nextItem(){
        btn.style.display='none'

        var category = "<?php echo $_POST['category']; ?>";
        var difficulty = "<?php echo $_POST['difficulty']; ?>";

        var url = `https://opentdb.com/api.php?amount=10&category=${category}&difficulty=${difficulty}&type=${counter > 4 ?  'multiple' : 'boolean'}`;
        counter += 1;


        var html = ''
        requestAjax(url, function(data){
          console.log(data.results[0]);
          var obj = data.results[0];

          html += '<div><div id="output"></div>Question '+counter+' of 10</div>';
          html += '<div><div class="cat">'+obj.category+'</div>';;
          html += '<div class="que">'+obj.question+'</div>';
          html += '</div>'
          output.innerHTML = html;
          questionBuilder(obj.correct_answer, obj.incorrect_answers)
        })
      }

      function correctAnswers(){
        var els = document.querySelectorAll('#selAnswers div')
        for(x=0; x<els.length; x++){
          if(els[x].getAttribute('data-cor')=="true"){
            return els[x].innerText
          }
        }
      }

      //TESTING FUNCTION
        function addFunction (x, y) {
        return (x + y);
       }

       function addFunctionTest(){
         var x = 7;
         var y = 8;
         var sum = addFunction(x, y);
         if(sum !=15){
           alert("Function doesnt work!!");
         }
       }
       //


      function sendAnswer(){
        var res = event.target.getAttribute('data-cor');
        var correctAnswerValue = correctAnswers();

        if (counter < 10) {
          btn.style.display='block'
        }

        if (counter >= 10) {
          submit.style.display='block'
        }

        if(res=='true'){

          answers.correct = addFunction(answers.correct, 1); //Testing answers.correct
          correctInput.value = answers.correct;
          selAnswer.innerHTML = 'Correct!!'

        }else{
          selAnswer.innerHTML = 'Wrong it was '+correctAnswerValue
        }
      }

      function questionBuilder(cor, incor){
        var holder = incor;
        holder.push(cor);
        holder.sort();
            selAnswer.innerHTML ="";
            for (var x = 0; x < holder.length; x++) {
              var el = document.createElement('div')
              var checker = holder[x] == cor ? true :false;
              el.setAttribute('data-cor',checker);
              el.innerHTML = holder[x];
              el.addEventListener('click', sendAnswer)
              selAnswer.appendChild(el);
            }
        }

      function requestAjax(url, callback){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
          if(xhr.readyState==4&&xhr.status==200){
            callback(JSON.parse(xhr.responseText))
          }
        }
        xhr.open('GET', url, true)
        xhr.send();
      }
    </script>
  </body>
</html>
