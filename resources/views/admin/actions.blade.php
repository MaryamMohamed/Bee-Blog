    <form action="admin/dashboard/blog/approveBlog/{{ $row->id }}" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-success">Approve</button> 
    </form>
    <form action="admin/dashboard/blog/pendBlog/{{ $row->id }}" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-primary">Pend</button> 
    </form>
    <form action="admin/dashboard/blog/declineBlog/{{ $row->id }}" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-danger">Decline</button> 
    </form>
    <button type="submit" class="btn r"><a href="admin/dashboard/ablog/{{ $row->id }}" style="color: white"> Show</a></button> 
