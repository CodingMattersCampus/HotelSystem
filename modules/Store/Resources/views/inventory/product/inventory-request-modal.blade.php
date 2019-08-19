<div id="inventory_request_modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white;">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <h3 class="modal-title">Inventory Request</h3>
            </div>
            <div class="modal-body">
                <form id="requestForm" method="POST" action="{{route('store.inventory.products.restock')}}" >
                    @csrf
                    <div class="dropdown">
                        <input type="text" id="item_search" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                        <ul id="searched-items" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="item_search">
                            <li class="list-group-item" disabled>Search Items</li>
                        </ul>
                    </div>
                    <table id="product_table" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
                        <thead class="bg-purple-gradient">
                            <tr>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                    <input type="hidden" name="requestItems" id='requestItems'>
                    <div class="form-group" style="" >
                        <button type="submit" class="btn btn-block">Submit</button>
                    </div>
                </form> <!-- / End requestForm / -->
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
            url: "{{\route('store.inventory.products.warehouse')}}",
            method: 'get',
            async: false,
            success:function(d){
                searchedProduct.data = d;
            }
        });
    },
    query(string, concern = null, groupBy=''){
        ret = Enumerable.from(this.data)
            .where(function(output){
                if(concern.searchable.length > 0){
                    console.log('called')
                    for (var i = 0; i < concern.searchable.length; i++) {
                        if (String(output[concern.searchable[i]]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                            return true;
                    }
                }
                for (var key in output) {
                    if (String(output[key]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                        return true;
                }
            })
            //how to modify this?
            .groupBy(function(obj){
                return obj['brand'];
            });
        return ret.toArray();
    }
};

$(document).ready(function(){
    $('#item_search').on('keyup',function(){
        if(searchedProduct.data == null){
            searchedProduct.search_data();
        }

        input = $(this),
        menu = $('#searched-items'),
        string = $(this).val(),
        menu.html('');  

        concern = {
            searchable: ['sku', 'brand', 'name'],
        }

        query = searchedProduct.query(string, concern, 'brand');
        
        query.forEach(function(obj){
            items = obj.toArray();
            li = $('<li/>')
                .addClass("list-group-item bg-aqua")
                .html(obj.key()/*brand*/);
            menu.append(li);
            items.forEach(item=>{
                li = $('<li/>')
                    .addClass("list-group-item")
                    .on('click',function(){
                        datatable.row.add(item).draw();
                    })
                    .html(item.name);
                menu.append(li);
            });
        });
    });

    var datatable = $('#product_table').DataTable({
        "dom": 't',
        "buttons": [],
        "deferRender": true,
        "columns": [
            { "data": "sku", orderable: true, searchable: true },
            { "data": "name", searchable: true, orderable: true },
            { "data": "brand", searchable: true, orderable: true },
            { "data": "quantity", "defaultContent": 1, searchable: false, orderable: false,
                render(d,t,r) {
                    r.quantity = r.quantity ? r.quantity : 1;
                    return '<input style="width:80px;" type="text" data-name="quantity" value="'+r.quantity+'"">';
                }
            },
            { "data": "remove", defaultContent: '<i class="fa fa-times text-red"></i>', "orderable": false, "searchable": false },
        ],
        data: [],
    });

    $('#product_table tbody').on('keyup',"input",function(event){
        row = datatable.row($(this).parents('tr')).data()
        row[$(this).data('name')] = $(this).val()
    });

    $('#product_table tbody').on( 'click', 'i.fa-times', function () {
        datatable
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } )

    datatable.on('draw', function(){
        data = datatable.rows().data().toArray();
        $('#requestItems').val(JSON.stringify(data));
    });

    $('#requestForm').on('submit', function(){
        datatable.draw()
        data = datatable.rows().data().toArray();
        return data.length > 0;
    });
});
</script>
@endpush