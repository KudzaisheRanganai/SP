$(()=>{
	$("#btnSave").on('click',function(e){
		e.preventDefault();
		console.log("Here");
		$.ajax({
			url:'PHPcode/backupdatabasecode.php',
			type:'POST',
			data:{choce:1},
			beforeSend:function(){
				$('.loadingModal').modal('show');
			}
		})
		.done(data=>{
			closeModal();
			console.log(data);
		});
	});
	
});

function closeModal() {
    $('.loadingModal').on('shown.bs.modal', function(e) {
        $(".loadingModal").modal("hide");
    });
}