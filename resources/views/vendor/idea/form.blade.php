<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col">
            <h5>
              <i class="fa fa-lightbulb-o fa-fw" aria-hidden="true"></i> |
              <b>Share your idea</b>
            </h5>
          </div>
        </div>
      </div>
      <div class="card-body clear-card">
        {{ csrf_field() }}
        <div class="form-group">
          <textarea class="form-control idea-text" rows="2" style="resize: none; width: 100%;" name="idea" placeholder="What's the idea?" id="idea" autofocus required></textarea>
          <small id="errorMsg" data="idea" class="form-text font-weight-bold"></small>
        </div>
        <hr>
        <div class="form-group text-right">
          <button class="btn btn-primary cursor-pointer" id="shareIdeaBtn">
            SHARE
            <i class="fa fa-bullhorn fa-fw" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
