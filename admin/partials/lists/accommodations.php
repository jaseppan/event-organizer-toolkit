<div class="wrap">
    <h1>Accommodation List</h1>

    

     <!-- Search bar -->
     <div class="eot-list-actions">
        <div class="eot-list-batch-actions">
            <select name="eot-batch-action-select" id="eot-batch-select">
                <option value="">Select an action</option>
                <option value="delete">Delete</option>
            </select>
            <button id="eot-batch-action-submit" class="eot-list-action-button">Submit</button>
        </div>
         <div class="eot-search-bar">
            <input type="text" id="eot-search" placeholder="Search by name">
            <button id="search-button" class="eot-list-action-button">Search</button>
        </div>
     </div>

    <!-- Pagination links -->
    <div class="pagination-container">
        <!-- Pagination links will be displayed here -->
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
        function fetchAccommodations(page) {
            $.ajax({
                url: eotScriptData.url,
                type: 'GET',
                data: {
                    items_per_page: 25, // Adjust items per page as needed
                    page: page
                },
                success: function(response) {
                    // Clear the previous list
                    $('#eot-list').empty();

                    // Create select all checkbox
                    var checkbox = $('<input></input>')
                    .attr('type', 'checkbox')
                    .attr('id', 'select-all')
                    .attr('name', 'accommodations[]');

                    // Create table header
                    var header = $('<tr></tr>');
                    header.append($('<th></th>').append(checkbox));
                    header.append('<th>Actions</th>');
                    header.append('<th>ID</th>');
                    header.append('<th>Name</th>');
                    $('#eot-list').append(header);

                    // Display accommodations
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
                            .text('Edit')
                            .on('click', function() {
                                // Handle edit action here
                                // You can use accommodation.id to identify the item to edit
                            });

                        var deleteLink = $('<a></a>')
                            .attr('href', '#')
                            .attr('class', 'delete-link')
                            .text('Delete')
                            .on('click', function() {
                                // Handle delete action here
                                // You can use accommodation.id to identify the item to delete
                            });

                        listItem.append($('<td></td>').append(checkbox));
                        listItem.append($('<td></td>').append(editLink).append(deleteLink));
                        listItem.append($('<td></td>').append(accommodation.id));
                        listItem.append($('<td></td>').text(accommodation.title));
                        
                        $('#eot-list').append(listItem);
                    });

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
                        fetchAccommodations(page);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching accommodations:', error);
                }
            });
        }

        // Initial fetch of accommodations on page load
        fetchAccommodations(1);

        // Example: Fetch accommodations for a specific page (e.g., page 2)
        // fetchAccommodations(2);
    });
</script>
