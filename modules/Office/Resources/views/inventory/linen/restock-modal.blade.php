<button data-toggle="modal" data-target="#linen-restock-modal" class="btn btn-primary">Restock Linens</button>
<div id="linen-restock-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white;">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <h3 class="modal-title">Restock Linens</h3>
            </div>
            <div class="modal-body">
                <form id="restockForm" method="POST" action="#" >
                    @csrf
                    <div class="dropdown" style="margin-bottom: 10px;">
                        <input type="text" id="item_search" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                        <ul id="searched-items" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="item_search">
                            <li class="list-group-item" disabled>Search Items</li>
                        </ul>
                    </div>
                    <table id="restock-table" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                        <thead class="bg-purple-gradient">
                            <tr>
                                <th>Name</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <input type="hidden" name="restock" id='restock'>
                    <div class="form-group" style="margin-top: 30px" >
                        <button type="submit" class="btn btn-block">Submit</button>
                    </div>
                </form> <!-- / End laundryForm / -->
            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $('#restock-table').DataTable({
        dom: 'f',
    });
});
</script>
@endpush