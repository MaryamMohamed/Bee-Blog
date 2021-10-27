    <form action="{{route('approveBlog', $model->id)}}" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-success">Approve</button> 
    </form>
    <form action="" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-primary">Pend</button> 
    </form>
    <form action="" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-danger">Decline</button> 
    </form>
    <button type="submit" class="btn r"><a href="" style="color: white"> Show</a></button> 
