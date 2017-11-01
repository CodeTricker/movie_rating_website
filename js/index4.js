var btn_rate = document.getElementById("rating");
var btn_title = document.getElementById("title");

var movie_title = document.getElementsByClassName("movie_by_title");
var movie_title_descend = document.getElementsByClassName("movie_by_title_descend");

var btn_descend_by_title = document.getElementById("descend_by_title");
var btn_ascend_by_title = document.getElementById("ascend_by_title");

var movie_rate = document.getElementsByClassName("movie_by_rate");
var movie_rate_descend = document.getElementsByClassName("movie_by_rate_descend");

var btn_descend_by_rate = document.getElementById("descend_by_rate");
var btn_ascend_by_rate = document.getElementById("ascend_by_rate");


btn_rate.addEventListener("click", function() 
{
    btn_rate.classList.add("hide_me");
	btn_descend_by_title.classList.add("hide_me");
	
	for (i = 0; i < movie_title.length; i++) 
	{
		movie_title[i].classList.add("hide_me");
	}
	
	for (i = 0; i < movie_rate.length; i++) 
	{
		console.log(movie_rate[i]);
		
		if(movie_rate[i].classList.remove("hide_me"))
			console.log("remove ok.");
		else
			console.log("remove bad.");
	}
	
	btn_title.classList.remove("hide_me");
	btn_descend_by_rate.classList.remove("hide_me");
	
}
);

btn_title.addEventListener("click", function() 
{
    btn_title.classList.add("hide_me");
	btn_descend_by_rate.classList.add("hide_me");
	
	for (i = 0; i < movie_rate.length; i++) 
	{
		movie_rate[i].classList.add("hide_me");
	}
	
	
	for (i = 0; i < movie_title.length; i++) 
	{
		console.log(movie_title[i]);
		
		if(movie_title[i].classList.remove("hide_me"))
			console.log("remove ok.");
		else
			console.log("remove bad.");
		//movie_title[i].classList.add("display_me");
	}

	btn_rate.classList.remove("hide_me");
	btn_descend_by_title.classList.remove("hide_me");
	
}
);



btn_descend_by_title.addEventListener("click", function() 
{
	btn_descend_by_title.classList.add("hide_me");
	btn_rate.classList.add("hide_me");
	
	for (i = 0; i < movie_title.length; i++) 
	{
		movie_title[i].classList.add("hide_me");
	}
	for (i = 0; i < movie_title_descend.length; i++) 
	{
		console.log(movie_title_descend[i]);
		
		if(movie_title_descend[i].classList.remove("hide_me"))
			console.log("remove ok.");
		else
			console.log("remove bad.");
	}
	
	btn_ascend_by_title.classList.remove("hide_me");
}
);

btn_ascend_by_title.addEventListener("click", function() 
{
	btn_ascend_by_title.classList.add("hide_me");
	//btn_rate.classList.add("hide_me");
	
	for (i = 0; i < movie_title_descend.length; i++) 
	{
		movie_title_descend[i].classList.add("hide_me");
	}
	for (i = 0; i < movie_title.length; i++) 
	{
		console.log(movie_title[i]);
		
		if(movie_title[i].classList.remove("hide_me"))
			console.log("remove ok.");
		else
			console.log("remove bad.");
	}
	
	btn_descend_by_title.classList.remove("hide_me");
	btn_rate.classList.remove("hide_me");
}
);



btn_descend_by_rate.addEventListener("click", function() 
{
	btn_descend_by_rate.classList.add("hide_me");
	btn_title.classList.add("hide_me");
	
	for (i = 0; i < movie_rate.length; i++) 
	{
		movie_rate[i].classList.add("hide_me");
	}
	for (i = 0; i < movie_rate_descend.length; i++) 
	{
		console.log(movie_rate_descend[i]);
		
		if(movie_rate_descend[i].classList.remove("hide_me"))
			console.log("remove ok.");
		else
			console.log("remove bad.");
	}
	
	btn_ascend_by_rate.classList.remove("hide_me");
}
);

btn_ascend_by_rate.addEventListener("click", function() 
{
	btn_ascend_by_rate.classList.add("hide_me");
	//btn_rate.classList.add("hide_me");
	
	for (i = 0; i < movie_rate_descend.length; i++) 
	{
		movie_rate_descend[i].classList.add("hide_me");
	}
	for (i = 0; i < movie_rate.length; i++) 
	{
		console.log(movie_rate[i]);
		
		if(movie_rate[i].classList.remove("hide_me"))
			console.log("remove ok.");
		else
			console.log("remove bad.");
	}
	
	btn_descend_by_rate.classList.remove("hide_me");
	btn_title.classList.remove("hide_me");
}
);
