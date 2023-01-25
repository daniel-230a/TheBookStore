$(window).on('load', function() {

  showBooks();

});


showBooks = (category_id, sub_category_id) => {

  $.ajax({
		type : 'POST',
		url : 'handle/displayBooks.php',
		data: {'category_id': category_id, 'sub_category_id': sub_category_id},
		success :   function(books) {
			
						$("#books_view").html(books);
					  
					}
	});	

}

//shows all the categories from DB
showCategory = () => {

  $.ajax({
    type : 'POST',
    url : 'handle/displayCategories.php',
    data: {'categories': true},
    success :   function(categories) {
      
      $("[aria-labelledby='categoryDropDown']").html(categories);
            
    }
  });	

}

//shows all the sub categories for selected category from DB
showSubCategories = (category_id, category_name) => {

  $.ajax({
    type : 'POST',
    url : 'handle/displayCategories.php',
    data: {'category_id': category_id},
    success :   function(sub_categories) {
      
      $("[aria-labelledby='subCategoryDropDown']").html(sub_categories);
      $("#categoryDropDown").html('<span class="sr-only" style="padding:5px">'+category_name+'</span>')
      $("#subCategoryDropDown").html('<span class="sr-only" style="padding:5px">Select</span>')
      showBooks(category_id)
            
    }
  });	

}

showSubCategory = (sub_category_id, sub_category_name) => {

  showBooks(null, sub_category_id)
  $("#subCategoryDropDown").html('<span class="sr-only" style="padding:5px">'+sub_category_name+'</span>')

}

