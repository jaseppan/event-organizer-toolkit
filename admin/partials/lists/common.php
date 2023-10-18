<div class="wrap">
    <h1><?php echo $topic ?> List</h1>

    <!-- Search bar -->
    <div class="eot-list-actions">
        <div id="eot-found-message"></div>
        <div class="eot-search-bar">
            <div id="search-bar-overlay" class="overlay">Search</div>
            <input type="text" id="eot-search">
        </div>
    </div>

     <!-- Actions bar -->
     <div class="eot-list-actions">
        <div class="eot-list-batch-actions">
            <!-- Overlay element for displaying the text -->
            <div id="list-batch-actions-overlay" class="overlay">Select an action</div>
            <select name="eot-batch-action-select" id="eot-batch-select">
                <option value=""></option>
                <option value="delete">Delete</option>
            </select>
            <button id="batch-action-submit" class="eot-list-action-button">Submit</button>
        </div>
        <!-- Pagination links -->
        <div class="pagination-container">
            <!-- Pagination links will be displayed here -->
        </div>
        <!-- Items per page -->
        <div class="items-per-page-container">
            <!-- Overlay element for displaying the text -->
            <div id="items-per-page-overlay" class="overlay">Items per page</div>
        
            <!-- Actual input field -->
            <input type="text" id="items-per-page" list="items-per-page-list">
            
            <datalist id="items-per-page-list">
                <option value="5">
                <option value="10">
                <option value="15">
                <option value="20">
                <option value="25">
                <option value="50">
                <option value="all">
            </datalist>
        </div>


     </div>

    <!-- Container to display list -->
    <table id="eot-list" class="eot-table">
        <!-- List items will be displayed here -->
    </table>

    <!-- Pagination links -->
    <div class="pagination-container">
        <!-- Pagination links will be displayed here -->
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        // Function to fetch and display list
        function fetchListItems() {

            // Initialize the data
            var data = {};

            // Get page
            var page = getUrlParameter('list-page');
            
            // Get items per page
            var itemsPerPage = getUrlParameter('items-per-page');
            // var itemsPerPage = $('#items-per-page').val();

            if ( itemsPerPage == null ) {
                data.items_per_page = 25;
                data.page = 1;
                updateUrlParameter('items-per-page', data.items_per_page);
                updateUrlParameter('list-page', data.page);
            } 
            
            if ( itemsPerPage !== null && itemsPerPage !== 'all' ) {
                
                if (page == undefined) {
                    page = 1;
                    updateUrlParameter('list-page', page);
                }

                data.items_per_page = itemsPerPage;
                data.page = page;
            }

            // Get search term
            var searchTerm = getUrlParameter('search');
            if( searchTerm !== null && searchTerm !== '') {
                data.search = searchTerm;
                $('#eot-search').val(searchTerm);
            }

            // Get sort by
            var orderBy = getUrlParameter('order-by');
            if( orderBy !== null && orderBy !== '') {
                data.order_by = orderBy;
            }

            // Get sort order
            var order = getUrlParameter('order');
            if( order !== null && order !== '') {
                data.order = order;
            }

            $.ajax({
                url: eotScriptData.url,
                type: 'GET',
                data: data,
                success: function(response) {
                    printListContent(response, true);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching list items:', error);
                }
            });
        }

        function printListContent(response) {
            

            // Clear the previous list
            $('#eot-list').empty();
            $('#eot-found-message').empty();
            
            // Add messager
            var message = response.data.message;
            $('#eot-found-message').append(message);

            // Add count of items

            items_per_page_field = getUrlParameter(name);
            if( items_per_page_field !== 'all') {
                if( response.data.count !== undefined ) {
                    items_per_page = response.data.count.items_per_page;
                    $('#items-per-page').val(items_per_page);
                } else {
                    $('#items-per-page').val(0);
                }
            }


            // Create table header
            // Append the header row to the table
            $('#eot-list').append('<thead></thead>');

            // Create table header
            var header = $('<tr></tr>');
            header.append('<th></th>');

            // Create the "Select All" checkbox in the table header
            var selectAllCheckbox = $('<input></input>')
                .attr('type', 'checkbox')
                .attr('id', 'select-all')
                .attr('name', 'select-all');

            // Add an event handler to the "Select All" checkbox
            selectAllCheckbox.on('change', function() {
                // Get the current state of the "Select All" checkbox
                var isChecked = $(this).prop('checked');
                
                // Set the state of all checkboxes in the table rows to match the "Select All" checkbox
                $('input[name="items[]"]').prop('checked', isChecked);
            });

            // Append the "Select All" checkbox to the table header
            header.find('th:first').append(selectAllCheckbox);

            // Sortable header for "Actions" column (non-sortable)
            header.append('<th>Actions</th>');

            // Sortable header for "ID" column
            var idHeader = $('<th></th>');
            var idSortLink = $('<a></a>')
                .attr('href', '#')
                .addClass('sort-link')
                .attr('data-sort', 'id')
                .text('ID');
            idHeader.append(idSortLink);
            header.append(idHeader);

            // Sortable header for "Title" column
            var titleHeader = $('<th></th>');
            var titleSortLink = $('<a></a>')
                .attr('href', '#')
                .addClass('sort-link')
                .attr('data-sort', 'title')
                .text('Title');
            titleHeader.append(titleSortLink);
            header.append(titleHeader);

            // Check if the ID column is currently sorted in ascending or descending order
            if (getUrlParameter('order-by') === 'id') {
                if (getUrlParameter('order') === 'asc') {
                    // Add an up arrow for ascending sorting
                    idSortLink.append($('<span></span>').addClass('sort-arrow up'));
                } else {
                    // Add a down arrow for descending sorting
                    idSortLink.append($('<span></span>').addClass('sort-arrow down'));
                }
            }
            
            // Check if the ID column is currently sorted in ascending or descending order
            if (getUrlParameter('order-by') === 'title') {
                if (getUrlParameter('order') === 'asc') {
                    // Add an up arrow for ascending sorting
                    titleSortLink.append($('<span></span>').addClass('sort-arrow up'));
                } else {
                    // Add a down arrow for descending sorting
                    titleSortLink.append($('<span></span>').addClass('sort-arrow down'));
                }
            }

            // Append the header row to the table
            $('#eot-list thead').append(header);

            // Display list
            response.data.data.forEach(function(item) {

                // Create a list item for each item
                var listItem = $('<tr></tr>');
                
                // Create checkbox
                var checkbox = $('<input></input>')
                    .attr('type', 'checkbox')
                    .attr('name', 'items[]')
                    .attr('value', item.id);
                
                // Create Edit and Delete links
                var editLink = $('<a></a>')
                    .attr('href', eotScriptData.current_url + '&tab=edit&id=' + item.id)
                    .attr('class', 'edit-link')
                    .text('Edit');

                    var deleteLink = $('<a></a>')
                        .attr('href', '#')
                        .attr('class', 'delete-link')
                        .attr('data-id', item.id) // Add the data-id attribute with the item ID
                        .text('Delete');

                // create order number


                listItem.append($('<td></td>').append(checkbox));
                listItem.append($('<td></td>').append(editLink).append(deleteLink));
                listItem.append($('<td></td>').append(item.id));
                listItem.append($('<td></td>').text(item.title));
                
                $('#eot-list').append(listItem);
            });

            if(  response.data._pagination !== undefined ) {
                // Display pagination links
                var pagination = response.data._pagination;
                var paginationHtml = '<ul class="pagination">';
                if (pagination.current_page > 1) {
                    paginationHtml += '<li><a href="#" data-page="1">&lt;&lt;</a></li>'; // Link to the first page
                    paginationHtml += '<li><a href="#" data-page="' + (pagination.current_page - 1) + '">&lt;</a></li>'; // Link to the previous page
                }

                var maxVisiblePages = 5; // Adjust the number of visible pages as needed
                var startPage = Math.max(pagination.current_page - Math.floor(maxVisiblePages / 2), 1);
                var endPage = Math.min(startPage + maxVisiblePages - 1, pagination.total_pages);

                for (var i = startPage; i <= endPage; i++) {
                    var activeClass = (i === pagination.current_page) ? 'active' : '';
                    paginationHtml += '<li class="' + activeClass + '"><a href="#" data-page="' + i + '">' + i + '</a></li>';
                }

                if (pagination.current_page < pagination.total_pages) {
                    paginationHtml += '<li><a href="#" data-page="' + (pagination.current_page + 1) + '">&gt;</a></li>'; // Link to the next page
                    paginationHtml += '<li><a href="#" data-page="' + pagination.total_pages + '">&gt;&gt;</a></li>'; // Link to the last page
                }
                paginationHtml += '</ul>';
                $('.pagination-container').html(paginationHtml);

                // Handle pagination clicks
                $('.pagination-container a').on('click', function(e) {
                    e.preventDefault();
                    var page = $(this).data('page');
                    updateUrlParameter('list-page', page);
                    fetchListItems();

                    // Update the URL with the new page parameter
                });
            } else {
                $('.pagination-container').html('');
            }
           
        }

        // Delete item
        $(document).on('click', '.delete-link', function(e) {
            e.preventDefault();
            
            // Get the item ID from the link's data attribute
            var itemId = $(this).data('id');

            // Confirm with the user before deleting
            if (confirm('Are you sure you want to delete this item?')) {
                
                // Send a DELETE request to the API
                $.ajax({
                    url: eotScriptData.deletion_url + '?id=' + itemId,
                    type: 'DELETE',
                    success: function(response) {
                        // Handle success, e.g., remove the deleted item from the list
                        // You may also want to display a success message to the user
                        fetchListItems(); // Refresh the list
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting item:', error);
                        // Handle the error, e.g., display an error message to the user
                    }
                });
            }
        });

        // Delete selected items
        $('#batch-action-submit').on('click', function() {
            var selectedIds = [];

            // Find all selected checkboxes
            $('input[name="items[]"]:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                alert('No items selected for deletion.');
                return;
            }

            if (confirm('Are you sure you want to delete ' + selectedIds.length + ' selected items(s)?')) {
                var deleteRequests = selectedIds.map(function(itemId) {
                    // Return a promise for each DELETE request
                    return $.ajax({
                        url: eotScriptData.deletion_url + '?id=' + itemId,
                        type: 'DELETE'
                    });
                });

                // Use $.when to wait for all DELETE requests to complete
                $.when.apply($, deleteRequests)
                    .then(function() {
                        // All DELETE requests have completed
                        console.log('Deletion completed.');
                        fetchListItems(); // Reload the table
                    })
                    .fail(function() {
                        // Handle any failures here
                        console.error('Error deleting items.');
                    });
            }
        });

        // Event listener for the search button
        $('#eot-search').on('input', function() {

            // Get search term from url parameter if defined
            var searchTerm = $('#eot-search').val();
            if( searchTerm.length < 3 ) {
                var search = getUrlParameter('search');
                if( search.length > 0 ) {
                    updateUrlParameter('search', '');
                    fetchListItems();
                }

                return;
            }

            // Call the searchitems function with the search term
            updateUrlParameter('search', searchTerm);
            updateUrlParameter('list-page', 1);
            // searchitems(1, searchTerm);
            fetchListItems();
        });

        // Sort items when a column header is clicked
        $(document).on('click', '.sort-link', function(e) {
            e.preventDefault();

            // Get the column to sort by from the data attribute
            var columnToSort = $(this).data('sort');

            // Get the current sort order from the URL parameter
            var currentOrder = getUrlParameter('order');
            
            // Determine the new sort order (toggle between 'asc' and 'desc')
            var newOrder = currentOrder === 'asc' ? 'desc' : 'asc';

            // Update the URL parameters for sorting
            updateUrlParameter('order', newOrder);
            updateUrlParameter('order-by', columnToSort);
            updateUrlParameter('list-page', 1); // Reset to the first page when sorting

            // Fetch items with the new sorting criteria
            fetchListItems();
        });

        // Items per page functionalities
        
        // Detect when the input field is clicked
        $('#items-per-page').on('mousedown', function() {
            // Clear the input field's value
            $(this).val('');
        });

        // Filter datalist options based on user input
        $('#items-per-page').on('input', function() {
            var userInput = $(this).val().toLowerCase();
            $('#items-per-page-list option').each(function() {
                var optionValue = $(this).val().toLowerCase();
                if (userInput === '' || optionValue.includes(userInput)) {
                    $(this).prop('hidden', false);
                } else {
                    $(this).prop('hidden', true);
                }
            });
        });

        $('#items-per-page').on('input', function() {
            // Get the numeric value entered by the user
            var newValue = $(this).val();
            // Check if the value is numeric
            if (!isNaN(newValue)) {
                
                // Update the URL parameter
                updateUrlParameter('items-per-page', newValue);
                removeUrlParameter('list-page', 1)
                // Fetch the table data with the new items-per-page value
                fetchListItems();
            }
        });

        $('#items-per-page').on('input', function() {
            var newValue = $(this).val().toLowerCase();
            if (newValue === 'all') {
                // Remove the items-per-page and list-page parameters from the URL
                updateUrlParameter('items-per-page', 'all');
                removeUrlParameter('list-page');
                // Fetch the table data without these parameters
                fetchListItems();
            }
        });



        fetchListItems();

    });

    // Function to update a URL parameter
    function updateUrlParameter(key, value) {
        var url = new URL(window.location.href);
        url.searchParams.set(key, value);
        history.pushState({}, '', url.toString());
    }

    // Function to get a URL parameter by name
    function getUrlParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    function removeUrlParameter(key) {
        // Get the current URL
        var url = new URL(window.location.href);

        // Remove the specified parameter
        url.searchParams.delete(key);

        // Replace the current URL without the parameter
        history.pushState({}, '', url.toString());
    }
    
</script>
