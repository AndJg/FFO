



    $(document).ready(function(){
 
        load_artists_data();
        
       function load_artists_data()
        {
         $.ajax({
          url:"http://localhost/ffo/core/ajax/rating.php",
          method:"POST",
          success:function(data)
          {
           $('#artists_list').html(data);
          }
         });
        }
        
        $(document).on('mouseenter', '.rating', function(){
         var index = $(this).data("index");
         var artist_id = $(this).data('artist_id');
         remove_background(artist_id);
         for(var count = 1; count<=index; count++)
         {
          $('#'+artist_id+'-'+count).css('color', '#ffcc00');
         }
        });
        
        function remove_background(artist_id)
        {
         for(var count = 1; count <= 5; count++)
         {
          $('#'+artist_id+'-'+count).css('color', '#ccc');
         }
        }
        
        $(document).on('mouseleave', '.rating', function(){
       var index = $(this).data("index");
         var artist_id = $(this).data('artist_id');
         var rating = $(this).data("rating");
         remove_background(artist_id);
         //alert(rating);
         for(var count = 1; count<=rating; count++)
         {
          $('#'+artist_id+'-'+count).css('color', '#ffcc00');
         }
        });
        
        $(document).on('click', '.rating', function(){
         var index = $(this).data("index");
         var artist_id = $(this).data('artist_id');
         $.ajax({
          url:"http://localhost/ffo/insert_rating.php",
          method:"POST",
          data:{index:index, artist_id:artist_id},
          success:function(data)
          {
           if(data == 'done')
           {
               load_artists_data();
            alert("You have rate "+index +" out of 5");
           }
           else
           {
            alert("There is some problem in System");
           }
          }
         });
         
        });
       
       });
       