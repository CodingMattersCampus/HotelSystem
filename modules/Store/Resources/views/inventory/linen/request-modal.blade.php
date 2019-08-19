<button data-toggle="modal" data-target="#request-linen-modal" class="btn btn-primary">Request Linens</button>
<div id="request-linen-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:rgb(60, 141, 188); color:white;">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <h3 class="modal-title">Request Linens to Office</h3>
            </div>
            <div class="modal-body">
                <form id="requestForm" method="POST" action="{{ route('store.inventory.linens.retrieve')}}" >
                    @csrf
                    <div class="dropdown" style="margin-bottom: 10px;">
                        <input type="text" id="item_search" data-toggle="dropdown" autocomplete="off" class="form-control" placeholder="Search Product" aria-label="Search Product">
                        <ul id="searched-items" class="dropdown-menu list-group" style="width: 100%; margin: 0px;" aria-labelledby="item_search">
                            <li class="list-group-item" disabled>Search Items</li>
                        </ul>
                    </div>
                    @if ($errors->has('linens'))
                        <span class="text-warning">{{ $errors->first('linens') }}</span>
                    @endif
                    <table id="request-table" class="table table-responsive table-striped table-condensed table-hover" style="width: 100%;">
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
            url: "{{\route('store.inventory.linens.laundry')}}",
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
                } else {
                    for (var key in output) {
                        if (String(output[key]).toLowerCase().indexOf(string.toLowerCase()) !== -1)
                            return true;
                    }
                }
            }).toArray();
    }
};
$(document).ready(function(){
    var datatable = $('#request-table').DataTable({
        "dom": 't',
        "buttons": [],
        "deferRender": true,
        "columns": [
            { "data": "name", searchable: true, orderable: true },
            { "data": "quantity", "defaultContent": 1, searchable: false, orderable: false,
                render(d,t,r) {
                    r.quantity = r.quantity ? r.quantity : 1;
                    return '<input style="width:80px;" class="form-control" type="text" required data-name="quantity" value="'+r.quantity+'"">';
                }
            },
            { "data": "remove", defaultContent: '<i class="fa fa-times text-red"></i>', "orderable": false, "searchable": false },
        ],
        data: [],
    });

    datatable.on('draw', function(){
        data = datatable.rows().data().toArray();
        $('#linens').val(JSON.stringify(data));
    });

    $('#request-table tbody').on('keyup',"input",function(event){
        row = datatable.row($(this).parents('tr')).data()
        row[$(this).data('name')] = $(this).val()
    });

    $('#request-table tbody').on( 'click', 'i.fa-times', function () {
        datatable
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } )

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

        if(query.length > 0){
            for (let obj of query){
                //stops adding same object on dt //wrong condition
                // if(datatable.rows().data().toArray().find(o => o.id == obj.id))
                //     continue; 
                li = $('<li/>')
                    .addClass("list-group-item")
                    .on('click',function(){
                        datatable.row.add(obj).draw();
                    })
                    .html(obj.name);
                menu.append(li);
            }

        } else {
            li = $('<li/>')
                .addClass("list-group-item")
                .html('No items found');
            menu.append(li);
        }
    });

    $('#requestForm').on('submit', function(){
        datatable.draw() //secure all data was written
        return datatable.rows().data().toArray().length > 0;
    });
});
</script>
@endpush