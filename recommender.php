<?php

include 'core/init.php';


?>
<h1 style="color:white; margin-bottom:20px;">You may like:</h1>
  <div class="grid-center">
    
   <?php $getFromBand->getTaste(); ?>
   
<h2 style="color:white; position: absolute; margin-top: 150px">Please let us know who your favorite artist is?</h2>
<h3 style="color:white; position: absolute; margin-top: 175px"> You can search  also by giving more general tips to our recommender! </h3>
<h3 style="color:white; position: absolute; margin-top: 200px ">For example you can let us know what your favorite instrument is, or simply say: "I love rock". </h3>

<input style="position: absolute; margin-top: 250px;" type="text" id="inputText" value="">
<input style="position: absolute; margin-top: 300px;" id="recTrig" type="submit" value="Submit">
<h2 style="color: white; position: absolute; margin-top: 350px;">You should check out:</h2>
<div id="trainAns" style="color: white; position: absolute; margin-top: 380px;"></div>

</div>

<script src="https://cdn.rawgit.com/BrainJS/brain.js/master/browser.js"></script>

<script>


const recTrig = document.querySelector("#recTrig");
const trainDiv = document.querySelector("#trainAns");
const inputText = document.querySelector("#inputText");

recTrig.addEventListener("click", function(){
   
const network = new brain.recurrent.LSTM();

const data = [
   {
        "genre": "Rock",
        "inspiration": "Nirvana",
        "mianInst": "guitar",
        "Recommend": "artistY"
      },
      {
        "genre": "Prog",
        "mianInst": "guitar",
        "inspiration": "Camel",
        "Recommend": "artistX"
      },
      {
        "genre": "Classical",
        "mianInst": "piano",
        "inspiration": "Karol Szymanowski",
        "Recommend": "artistZ"
      },
      {
        "genre": "Metal",
        "mianInst": "guitar",
        "inspiration": "Mgla",
        "Recommend": "artistU"
      },
      {
        "genre": "Prog",
        "mianInst": "guitar",
        "inspiration": "Death",
        "Recommend": "artistX"
      },
      {
        "genre": "Rock",
        "mianInst": "guitar",
        "inspiration": "Queen",
        "Recommend": "artistE"
      },
      {
        "genre": "Jazz",
        "mianInst": "drums",
        "inspiration": "Nina Simone",
        "Recommend": "artistW"
      },
      {
        "genre": "Rock",
        "mianInst": "guitar",
        "inspiration": "Queen",
        "Recommend": "artistE"
      },
      {
        "genre": "Rock",
        "mianInst": "guitar",
        "inspiration": "Red Hot Chili Peppers",
        "Recommend": "artistP"
      },
      {
        "genre": "Rock",
        "mianInst": "guitar",
        "inspiration": "Tool",
        "Recommend": "artistI"
      },
      {
        "genre": "Rock",
        "mianInst": "vocal",
        "inspiration": "Radiohead",
        "Recommend": "artistU"
      },
      {
        "genre": "Rock",
        "mianInst": "vocal",
        "inspiration": "Tool",
        "Recommend": "artistI"
      },
      {
        "genre": "Jazz",
        "mianInst": "saxophone",
        "inspiration": "John Coltrane",
        "Recommend": "artistT"
      },
      {
        "genre": "Classical",
        "mianInst": "violin",
        "inspiration": "Witold Lutoslawski",
        "Recommend": "artistZ"
      },
      {
        "genre": "Classical",
        "mianInst": "piano",
        "inspiration": "Frederic Chopin",
        "Recommend": "artistZ"
      },
      {
        "genre": "Classical",
        "mianInst": "piano",
        "inspiration": "Ludwig van Beethoven",
        "Recommend": "artistZ"
      },
      {
        "genre": "Classical",
        "mianInst": "piano",
        "inspiration": "Johann Sebastian Bach",
        "Recommend": "artistZ"
      },
      {
        "genre": "Classical",
        "mianInst": "piano",
        "inspiration": "Antonio Vivaldi",
        "Recommend": "artistZ"
      }
   ]

const trainingData = data.map(item => ({

    input: item.genre, 
    input: item.inspiration,
    input: item.mianInst,
    output: item.Recommend

}));

network.train(trainingData,{

    iterations: 1000
});

const input = inputText.value;

const output = network.run(input);

trainAns.innerText = output;

}); 

</script>


