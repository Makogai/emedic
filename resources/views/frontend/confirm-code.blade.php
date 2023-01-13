
@error('code')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<form action="{{route('code.confirmCode')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control" placeholder="Enter code" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


