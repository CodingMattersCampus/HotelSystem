<button data-toggle="modal" data-target="#linen-laundry-modal" class="btn btn-primary">Retrieve Laundries</button>
<div id="linen-laundry-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white;">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <h3 class="modal-title">Linen Laundry</h3>
            </div>
            <div class="modal-body">
                <form id="laundryForm" method="POST" action="{{ route('office.inventory.linens.retrieve') }}" >
                    @csrf
                    <div class="dropdown" style="margin-bottom: 10px;">
                        <input type="text" id="item_search" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                        <ul id="searched-items" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="item_search">
                            <li class="list-group-item" disabled>Search Items</li>
                        </ul>
                    </div>
                    <table id="linen-table" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                        <thead class="bg-purple-gradient">
                            <tr>
                                <th>Name</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <input type="hidden" name="linens" id='linens'>
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
var searchedProduct = {
    data: null,
    search_data(){
        $.ajax({
            url: "{{\route('office.inventory.linens.laundry')}}",
            method: 'get',
            async: false,
            success:function(d){
                searchedProduct.data = d;
            }
        });
    },
    query(string, concern = null){
        return Enumerable.from(this.data)
            .where(function(output){
                if(concern.searchable.length > 0){
                    for (var i = 0; i < concern.searchable.length; i++) {
                        if (String(output[concern.searchable[i]]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                            return true;
                    }
                }
                for (var key in output) {
                    if (String(output[key]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                        return true;
                }
            }).toArray();
    }
};
$(document).ready(function(){
    $('#linen-table').DataTable({
        dom: '',
    });

    $('#item_search').on('keyup',function(){
        if(searchedProduct.data == null){
            searchedProduct.search_data();
        }

        input = $(this),
        menu = $('#searched-items'),
        string = $(this).val(),
        menu.html('');  

        concern = {
            searchable: ['name'],
        }

        query = searchedProduct.query(string, concern);
        query.forEach(function(obj){
            li = $('<li/>')
                .addClass("list-group-item")
                .on('click',function(){
                    datatable.row.add(obj).draw();
                })
                .html(obj.name);
            menu.append(li);
        });
    });
});
</script>
@endpush