<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Xác nhận lại</h4>
            </div>

            <div class="modal-body">
                <p>Bạn có chắc muốn xóa!</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <form id="form_delete" method="post" action="" >
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" id="delete_link" class="btn btn-danger btn-ok">Xóa</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
        $('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('form_delete').setAttribute('action' , delete_url);
    }
</script>
