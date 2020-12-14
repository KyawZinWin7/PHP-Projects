

$(document).ready(function() {

	
	showdata();
	$(".btn_add").click(function() {
		// alert("ok");
		
		var id = $(this).data('id');
		// alert(id);
		var name=$(this).data("name");
		// alert(name);
		var photo=$(this).data('photo');
		// alert(photo);
		var codeno=$(this).data('codeno');
		var price=$(this).data('price');
		var discount = $(this).data('discount');
		



		var items={
			id:id,
			name:name,
			photo:photo,
			codeno:codeno,
			price:price,
			discount:discount,
			qty:1

		}
		var itemlist=localStorage.getItem("items");
		var itemarray;
		if (itemlist ==null) {
			itemarray=[];
		}else{
			itemarray=JSON.parse(itemlist);
		}
		var status = false;
		$.each(itemarray,function(i,v) {
			if (v.id==id) {
				v.qty++;
				status=true;
			}
		})
		if (!status) {
			itemarray.push(items);

		}
		var itemstring=JSON.stringify(itemarray);
		localStorage.setItem("items",itemstring);
		showdata();
	})

	function showdata() {
		var itemlist = localStorage.getItem("items");

		var itemarray =JSON.parse(itemlist);
		var html="";
		var j=1;
		var total=0;
		$.each(itemarray,function(i,v) {
			if (v.discount) {
				var nprice = v.discount;
			}
			else{
				var nprice = v.price;
			}
			var subtotal = nprice * v.qty;
			total+= subtotal;
			html+=`
						<tr>
							<td>
								<button class="btn btn-outline-danger remove btn-sm" style="border-radius: 50%"> 
									<i class="icofont-close-line"></i> 
								</button> 
							</td>
							<td> 
								<img src="${v.photo}" class="cartImg" width="50px" height="50px">						
							</td>
							<td> 
								<p> ${v.name} </p>
								<p> ${v.codeno}</p>
							</td>
							<td>
								<button class="btn btn-outline-secondary plus_btn"> 
									<i class="icofont-plus"></i> 
								</button>
							</td>
							<td>
								<p> ${v.qty} </p>
							</td>
							<td>
								<button class="btn btn-outline-secondary minus_btn"> 
									<i class="icofont-minus"></i>
								</button>
							</td>
							<td>
								<?php if (v.discount > 0) { ?>
									<p class="text-danger"> 
									<?= ${v.discount} Ks ?>
									</p>

									<p class="font-weight-lighter"> 
										<del><?= ${v.price} Ks ?> </del> 
									</p>}
								<?php } else { ?>
									<p class="text-danger"> 
									<?= ${v.price} Ks ?>
									</p>
								<?php } ?>
								
								
							</td>
							<td>
								<p>${subtotal}Ks</p>
							</td>
						</tr>



			`

		})
		html+=`
			<tr>
				<td colspan="8">
				<h3 class="text-right"> Total : 
					${total}
				 </h3>
			</td>

			</tr>

		`;

		$("#shoppingcart_table").html(html);
	}

});



$('.checkoutbtn').on('click',function() {
	var notes = $('#notes').val();
	var cart = localStorage.getItem("items");
	var cartarray= JSON.parse(cart);
	var total=0;
	var noti=0;
	$.each(cartarray,function(i,v) {
		if (v.discount) {
			var nprice = v.discount; 
		}
		else{
			var nprice = v.price;
		}
		var subtotal = nprice * v.qty;
		
		total+= subtotal ++;
	});
	// console.log(total);

	$.post('storeorder.php',{
		cart:cartarray,
		notes: notes,
		total:total
	},function(response) {
		localStorage.clear();
		location.href="ordersuccess.php";
	});
});



