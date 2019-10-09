var assignments;
var assignmentProduct;
let buildTable=function(tmp,assArr,assPArr)
{
	let tableEntry=$("<tr></tr>");
	let form=$("<td></td>");
	let saleID=assArr[tmp]["ORDER_ID"];
	let saleArr=assArr.filter(element=>element["ORDER_ID"]==saleID);
	let saleProductsArr=assPArr.filter(element=>element["ORDER_ID"]==saleID);
	console.log(saleArr[0]["ADDRESS_NAME"]);
	console.log(saleProductsArr);
	let saleEntry=$("<td></td>").text(assArr[tmp]["ORDER_ID"]);
	tableEntry.append(saleEntry);
	let formEntry="<form action='finalise_collection.php' method='GET'><input type='hidden' name='ass' value='"+JSON.stringify(saleArr)+"'>"+"<input type='hidden' name='assP' value='"+JSON.stringify(saleProductsArr)+"'>"+"<input type='hidden' name='address' value='"+saleArr[0]["ADDRESS_NAME"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-truck'></i></span><span class='btn-inner--text'>Make Collection</span></button>";
	form.append(formEntry);
	tableEntry.append(form);
	$("#tBody").append(tableEntry);
}
$(()=>{
	assignments=JSON.parse($("#aData").text());
	assignmentProduct=JSON.parse($("#apData").text());
	for(let k=0;k<assignments.length;k++)
	{
		buildTable(k,assignments,assignmentProduct);
	}

});

function myFunction() 
{
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  var showCount = 0;
  for (i = 0; i < tr.length; i++) 
  {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) 
    {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter)> -1) 
      {
        tr[i].style.display = "";
        showCount += 1;
      } 
      else 
      {
        tr[i].style.display = "none";
      }
    }       
  }

  if (showCount === 0)
  {
    $("#emptySearch").show();
  } 
  else
  {
    $("#emptySearch").hide();
  }
}