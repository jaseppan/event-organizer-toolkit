<div class="wrap">
    <h1>Accommodation List</h1>

    <!-- Search bar -->
    <div class="eot-list-actions">
        <div id="eot-found-message"></div>
        <div class="eot-search-bar">
            <input type="text" id="eot-search" placeholder="Search">
        </div>
    </div>

     <!-- Actions bar -->
     <div class="eot-list-actions">
        <div class="eot-list-batch-actions">
            <select name="eot-batch-action-select" id="eot-batch-select">
                <option value="">Select an action</option>
                <option value="delete">Delete</option>
            </select>
            <button id="eot-batch-action-submit" class="eot-list-action-button">Submit</button>
        </div>
        <!-- Pagination links -->
        <div class="pagination-container">
            <!-- Pagination links will be displayed here -->
        </div>
         <div class="count-of-items-container">
            <input type="text" id="count-of-items" placeholder="Count of items">
        </div>
     </div>

    <!-- Container to display accommodation list -->
    <table id="eot-list" class="eot-table">
        <!-- Accommodations will be displayed here -->
    </table>

    <!-- Pagination links -->
    <div class="pagination-container">
        <!-- Pagination links will be displayed here -->
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        // Function to fetch and display accommodations
        function fetchAccommodations() {

            
            // Get page
            var page = getUrlParameter('list-page');
            if (page == undefined) {
                page = 1;
                updateUrlParameter('list-page', page);
            }

            // Get items per page
            var itemsPerPage = getUrlParameter('items-per-page');
            if (itemsPerPage == null    ) {
                itemsPerPage = 10;
                updateUrlParameter('items-per-page', itemsPerPage);
            }

            data = {
                items_per_page: itemsPerPage,
                page: page
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
                    console.error('Error fetching accommodations:', error);
                }
            });
        }

        function printListContent(response) {

            // Clear the previous list
            $('#eot-list').empty();
            $('#eot-found-message').empty();

            // Add count of items
            var message = response.data.message;
            $('#eot-found-message').append(message);
            if( response.data.count !== undefined ) {
                items_per_page = response.data.count.items_per_page;
                $('#count-of-items').val(items_per_page);
            } else {
                $('#count-of-items').val(0);
            }

            // Create table header

            // Create select all checkbox
            var checkbox = $('<input></input>')
            .attr('type', 'checkbox')
            .attr('id', 'select-all')
            .attr('name', 'accommodations[]');

            var header = $('<tr></tr>');
            header.append($('<th></th>').append(checkbox));
            header.append('<th>Actions</th>');
            header.append('<th>ID</th>');
            header.append('<th>Name</th>');
            $('#eot-list').append(header);

            // Display list
            response.data.data.forEach(function(accommodation) {

                // Create a list item for each accommodation
                var listItem = $('<tr></tr>');
                
                // Create checkbox
                var checkbox = $('<input></input>')
                    .attr('type', 'checkbox')
                    .attr('name', 'accommodations[]')
                    .attr('value', accommodation.id);
                
                // Create Edit and Delete links
                var editLink = $('<a></a>')
                    .attr('href', eotScriptData.current_url + '&tab=edit&id=' + accommodation.id)
                    .attr('class', 'edit-link')
                    .text('Edit');

                    var deleteLink = $('<a></a>')
                        .attr('href', '#')
                        .attr('class', 'delete-link')
                        .attr('data-id', accommodation.id) // Add the data-id attribute with the accommodation ID
                        .text('Delete');

                // create order number


                listItem.append($('<td></td>').append(checkbox));
                listItem.append($('<td></td>').append(editLink).append(deleteLink));
                listItem.append($('<td></td>').append(accommodation.id));
                listItem.append($('<td></td>').text(accommodation.title));
                
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
                for (var i = 1; i <= pagination.total_pages; i++) {
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
                    fetchAccommodations();
    
                    // Update the URL with the new page parameter
                });
            } else {
                $('.pagination-container').html('');
            }
           
        }
        
        fetchAccommodations();

        // Delete item
        $(document).on('click', '.delete-link', function(e) {
            e.preventDefault();
            
            // Get the accommodation ID from the link's data attribute
            var accommodationId = $(this).data('id');

            // Confirm with the user before deleting
            if (confirm('Are you sure you want to delete this accommodation?')) {
                
                // Send a DELETE request to the API
                $.ajax({
                    url: eotScriptData.rest_api_url + '/v1/delete-accommodation?id=' + accommodationId,
                    type: 'DELETE',
                    success: function(response) {
                        // Handle success, e.g., remove the deleted item from the list
                        // You may also want to display a success message to the user
                        fetchAccommodations(); // Refresh the list
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting accommodation:', error);
                        // Handle the error, e.g., display an error message to the user
                    }
                });
            }
        });

        // Event listener for the search button
        $('#eot-search').on('input', function() {

            
            // Get search term from url parameter if defined
            var searchTerm = $('#eot-search').val();
            if( searchTerm.length < 3 )
                return;

            console.log(searchTerm);
            // Call the searchAccommodations function with the search term
            updateUrlParameter('search', searchTerm);
            updateUrlParameter('list-page', 1);
            // searchAccommodations(1, searchTerm);
            fetchAccommodations();
        });

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
</script>
