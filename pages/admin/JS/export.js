	
	var fs = require('fs');
	var jsdom = require("jsdom");
	
	var $ = require('jQuery');


$.ajax({
		url:'PHPcode/viewAuditCode.php',
		type:'POST',
		data:{choice:3}
	})
	.done(data=>{
		if(data!="False")
		{	
		}

		console.log(data);
	});

//create a file named mynewfile3.txt:
fs.writeFile('mynewfile3.txt', 'Hello content!', function (err) {
  if (err) throw err;
  console.log('Saved!');
});