<div class="row">
    <form action="">
        <div class="col-md-10">
            <textarea class="form-control" name="description" cols="30" rows="4">{{$action->description}}</textarea>
        </div>
        <div class="col-md-2">
            <div class="input-group clockpicker">
                <input type="text" class="form-control" value="{{$action->start_time}}">
                <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
            </div>
            <hr class="time-hr">
            <div class="input-group clockpicker">
                <input type="text" class="form-control" value="{{$action->end_time}}">
                <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
            </div>
        </div>
    </form>
</div>