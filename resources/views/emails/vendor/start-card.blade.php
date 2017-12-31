<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td width="100%" bgcolor="#ffffff"
        style="border-left: 5px solid #5383d3; border-right: 5px solid #e51178">
      <table width="100%" cellpadding="20" cellspacing="0" border="0">
        <tr>
          <td>
            <br class="hide">
            @if (isset($logo))
              <center>
                <img src="{{ $logo['path'] }}" width="{{ $logo['width'] }}px" height="{{ $logo['height'] }}px" alt="{{ $senderName or '' }}" style="-ms-interpolation-mode:bicubic;">
              </center>
            @endif
            <br class="hide">
          </td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" class="contentblock">
