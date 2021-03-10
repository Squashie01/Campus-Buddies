function Menu()
{
	var menu = document.getElementById("MenuBar");
	var student = document.getElementById("StudentSignIn");
	var tutor = document.getElementById("TutorSignIn");
	var admin = document.getElementById("AdminSignIn");

	if(menu.style.display === "none")
	{
		menu.style.display = "block";
		student.style.display = "none";
		tutor.style.display = "none";
		admin.style.display = "none";
	}
	else
	{
		menu.style.display = "none";
	}
}


function Student()
{
	var menu = document.getElementById("MenuBar");
	var student = document.getElementById("StudentSignIn");

	if(student.style.display === "none")
	{
		student.style.display = "block";
		menu.style.display = "none";
	}
	else
	{
		student.style.display = "none";
		menu.style.display = "block";
	}
}


function Tutor()
{
	var menu = document.getElementById("MenuBar");
	var tutor = document.getElementById("TutorSignIn");

	if(tutor.style.display === "none")
	{
		tutor.style.display = "block";
		menu.style.display = "none";
	}
	else
	{
		tutor.style.display = "none";
		menu.style.display = "block";
	}
}

function Admin()
{
	var menu = document.getElementById("MenuBar");
	var admin = document.getElementById("AdminSignIn");

	if(admin.style.display === "none")
	{
		admin.style.display = "block";
		menu.style.display = "none";
	}
	else
	{
		admin.style.display = "none";
		menu.style.display = "block";
	}
}