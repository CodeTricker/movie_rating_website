/*
$(document).ready(function() 
{
        
	$('.rate_widget').each(function(i) 
	{
		var widget = this;
		var out_data = 
		{
			widget_id : $(widget).attr('id'),
			fetch: 1
		};
		$.post(
			'ratings.php',
			out_data,
			function(INFO) 
			{
				$(widget).data( 'fsr', INFO );
				set_votes(widget);
			},
			'json'
		);
	});


	
*/



//var btn = getElementById("btn");

var logged_in = document.getElementById("logged_in");
logged_in = logged_in.value;
logged_in = parseInt(logged_in);
/* 
var exist = document.getElementById("exist");
exist = exist.value;
exist = parseInt(exist);
*/


console.log("logged_in= ", logged_in);

//console.log("exist= ", exist);


var rating = document.getElementById("rating");
var rate = rating.value;
rate = parseInt(rate);
console.log("rate= ", rate);

var user_id = document.getElementById("user_id");
	user_id = user_id.value;
	user_id = parseInt(user_id);
	
var new_rating = document.getElementById("new_rating");
	new_rating = new_rating.value;
	new_rating = parseInt(new_rating);

var movie_id = document.getElementById("movie_id");
	movie_id = movie_id.value;
	movie_id = parseInt(movie_id);
/* 	
var title = document.getElementById("title");
	title = title.value;
	title = $.parseJSON(title);
console.log("title= ", title); */
	
var stars = document.getElementsByClassName("ratings_stars");
//var btn = document.getElementById("btn");

var i =0;
while(i<rate)
{
	stars[i].classList.add("ratings_vote");
	i++;
}
/* 
if(rate==0)
{
	$('.never').removeClass(hide_me);
}
 */
/* 

 */

/* 
btn.addEventListener("click", function() 
{
	console.log("hey rating is", rate);
	
	/* for(i=0; i<rating; i++)
	{
		console.log("hey i is", i);
		stars[i].classList.add("ratings_vote");
	} */
	/*
	var i =0;
	while(i<rate)
	{
		console.log("hey i is", i);
		stars[i].classList.add("ratings_vote");
		i++;
	}
	console.log("hey i is", i);
}
);

 */
 
 

if(logged_in == 1)
{
	console.log("logged_in= ", logged_in);
	  
	if(rate==0)
	{
		$('.submitted').addClass("hide_me");
		$('.never').removeClass("hide_me");
	}
	  
	$('.btn').removeClass("hide_me");
	
	$('.ratings_stars').hover
	(
		// Handles the mouseover
		function() 
		{
			$(this).prevAll().andSelf().addClass('ratings_over');
			//$(this).nextAll().removeClass('ratings_vote');
		},
		// Handles the mouseout
		function() 
		{
			$(this).prevAll().andSelf().removeClass('ratings_over');
			// can't use 'this' because it wont contain the updated data
			//var rating = rate;
			//set_votes($(this).parent(), rating);
		}
	);


	$('.ratings_stars').click
	(
		function() 
		{
			//var rating = $(this).value;
			console.log("this= ", $(this));
			//console.log("rating= ", rating);
			/* var clicked_data = 
				{
					clicked_on : $(star).attr('class'),
					widget_id : $(star).parent().attr('id')
				}; */
			//var rating = clicked_on : $(star).attr('class');
			var a = $(this).attr('class');
			console.log("attribute= ", a);
			
			//var id = $(this).parent().attr('id');
			var rating = $(this).attr('value');
			rating = parseInt(rating);
			console.log("rating= ", rating);
			
			
			console.log("movie_id= ", movie_id);//movie_id
			
			new_rating = rating;
			//console.log("new rating= ", new_rating);
			
			set_votes($(this).parent(), rating);
			/* 
			$.ajax
		   (
		   {  
				url:"rate.php",  
				method:"POST",  
				data:{rating:rating, movie_id:movie_id},  
				success:function(data)
				{  
					 $('#new_result').html(data);  
				}  
		   }
		   );
			 */
			
		}

	);

	$('.btn').click
	(
		function() 
		{
			console.log("button: user_id= ", user_id);
			console.log("button: movie_id= ", movie_id);
			console.log("button: new_rating= ", new_rating);
			
			
			$.ajax
		   (
		   {  
				url:"rate.php",  
				method:"POST",  
				data:{new_rating:new_rating, movie_id:movie_id, user_id:user_id},  
				success:function(data)
				{  
					
					window.location.reload(true);
						
				}  
		   }
		   );
			
			
			
			
		}
		  
		
		 
	);



	/* 
	btn.addEventListener("click", function() 
	{
		
		
		
		$.ajax
	   (
	   {  
			url:"rate.php",  
			method:"POST",  
			data:{new_rating:new_rating, movie_id:movie_id},  
			success:function(data)
			{  
				 $('#new_result2').html(data);  
			}  
	   }
	   );
		
	}
	);

	 */



	function rate_star()
	{
		 //var star = $(this);
		 var star = $(this).value;
		 console.log("star=", star);
	}

	function rate1()
	{
		var star=1;
		console.log("star=", star);
		set_vote(star);
	}

	/* 
	$('.ratings_stars').bind('click', function() 
	{
				var star = this;
				var widget = $(this).parent();
				
				var clicked_data = 
				{
					clicked_on : $(star).attr('class'),
					widget_id : $(star).parent().attr('id')
				};
				$.post(
					'ratings.php',
					clicked_data,
					function(INFO) 
					{
						//widget.data( 'fsr', INFO );
						set_votes(widget);
					},
					'json'
				); 
	}
	);

	 */

	 /* 
	function set_vote(widget, rating)
	{
		//var rate = $(rating);
		//var rate = rating;
		
		console.log("vote rating= ", rating);
		
		$(widget).find('.star_' + rating).prevAll().andSelf().addClass('ratings_vote');
		$(widget).find('.star_' + rating).nextAll().removeClass('ratings_vote');
	}
	  */
	 
	function set_votes(widget, ratings) 
	{
		$(widget).find('.star_' + ratings).prevAll().andSelf().addClass('ratings_vote');
		$(widget).find('.star_' + ratings).nextAll().removeClass('ratings_vote');
	}	


}
else
{
	//$('.btn').addClass("hide_me")
}


	
	
	
/*
	// This actually records the vote
	$('.ratings_stars').bind('click', function() 
	{
		var star = this;
		var widget = $(this).parent();
		
		var clicked_data = 
		{
			clicked_on : $(star).attr('class'),
			widget_id : $(star).parent().attr('id')
		};
		$.post(
			'ratings.php',
			clicked_data,
			function(INFO) 
			{
				widget.data( 'fsr', INFO );
				set_votes(widget);
			},
			'json'
		); 
	});
        
        
        
});
*/

/* 
    function set_votes(widget) 
	{
		/* 
        var avg = $(widget).data('fsr').whole_avg;
        var votes = $(widget).data('fsr').number_votes;
        var exact = $(widget).data('fsr').dec_avg;
		 */
		//var votes = '<?php echo $votes; ?>';
		//var rating = '<?php echo $rating; ?>';
		
		/* 
        window.console && console.log('and now in set_votes, it thinks the fsr is ' + $(widget).data('fsr').number_votes);
        
        $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
        $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote');
		*/
		
        //$(widget).find('.total_votes').text( votes + ' votes recorded (' + rating + ' rating)' );
    //}
    // END FIRST THING
