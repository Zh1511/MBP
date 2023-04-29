<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <style>
    .text-primary {
        padding-bottom: 25px;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    span.page-link {
        cursor: pointer;
    }

    .pagination {
        justify-content: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h2 class="text-center text-primary">Ajax</h2>
                    <div id="get_data"></div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function fetch_data(page) {
        $.ajax({
            url: 'pagination.php',
            method: 'POST',
            data: {
                page: page
            },
            success: function(data) {
                $("#get_data").html(data);
            }
        });
    }

    fetch_data();

    $(document).on("click", ".page-item", function() {
        var page = $(this).attr("id");
        fetch_data(page);
    })
    </script>
</body>

</html>