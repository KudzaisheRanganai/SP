$(()=>{
	alert("Hello");
	$("#btnSearchSupplier").on('click',function(e){
		e.preventDefault();
		alert("Here");
		window.location.href="pages/supplier/search-supplier.php";
		$.ajax({
			url: 'PHPcode/addSupplierCode.php',
			type: 'POST',
			data: {choice:3}
		})
		.done(data=>{
			if(data=="True")
			{

			}
			else
			{
				window.location.href("pages/supplier/search-supplier.php");
			}
		});
	});

});