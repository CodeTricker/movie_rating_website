

var logged_in = document.getElementById("log");
	logged_in = logged_in.value;
	logged_in = parseInt(logged_in);
	
var log_in = document.getElementById("log_in");
var register = document.getElementById("register");
var log_out = document.getElementById("log_out");
	
if(logged_in == 1)
{
	log_in.classList.add("hide_me");
	register.classList.add("hide_me");
	
	log_out.classList.remove("hide_me");
}
else
{
	console.log("logged_in= ", logged_in);
	
	log_out.classList.add("hide_me");
	
	log_in.classList.remove("hide_me");
	register.classList.remove("hide_me");
}


var box = document.getElementById("checkAll");
box.addEventListener("click", function() 
{
	$('input:checkbox').not(this).prop('checked', this.checked);
	console.log("HEYYYYYYYYYYY");
}
);



$(document).ready(function()
{  
	$('#btn').click(function()
	{  
	   var categories = [];  
	   
	   $('.category').each(function()
	   {  
			if($(this).is(":checked"))  
			{  
				 categories.push($(this).val());  
			}  
	   }
	   );
	   
	   //categories = categories.toString();  
	   
	   $.ajax
	   (
	   {  
			url:"search_movie.php",  
			method:"POST",  
			data:{categories:categories},  
			success:function(data)
			{  
				 $('#search_result').html(data);  
			}  
	   }
	   );
	   
	}
	);
	
}
);
/* 
$(document).ready(function()
{  
	$('#rating').click(function()
	{
		console.log("click");

		
	}
	);
}
);

 */
