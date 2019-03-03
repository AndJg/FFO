var ajax = new XMLHttpRequest();
var method = "GET";
var url = "data.php";
var asynchronus = true;

ajax.open(method, url, asynchronus);
ajax.send();

ajax.onreadystatechange = function(){

    if(this.readyState == 4 && this.status == 200){

        
        var data = JSON.parse(this.responseText);
      
     
        // var trainingData = "";
        
        for(var i = 0; i < data.length; i++)
        {

            var genre = data[i].genre;
            var name = data[i].name;
            var forrmed_in = data[i].forrmed_in;

                
        }
        
     }


    
}
