<div id="modal-calendar" class="modal">
    <div class="modal-content">
      <h4 class="event-name"></h4>
      <p class="description"></p>
      <div class="modal-box">
        <div class="row">
        <?php foreach ($cast as $castRow): ?>
          <form id="edit-calendar" name="edit_calendar" method="post" action="/owner/casts/edit_calendar/<?= $castRow->id ?>">
          <div style="display:none;">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="crud_type" value="">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="cast_id" value="<?= $castRow->id ?>">
            <input type="hidden" name="start" value="">
            <input type="hidden" name="end" value="">
            <input type="hidden" name="all_day" value="">
            <input type="hidden" name="active" value="">
            <input type="hidden" name="calendar_path" value="<?='/'.$infoArray['dir_path'].'cast/'.$castRow->dir.'/calendar.json' ?>">
          </div>
          <div class="row">
            <div class="col">
            <label>対象日</label>
            <h5 class="target-day"></h5>
            <p>
              <input type="checkbox" id="all-day" name="all_day" checked="checked" disabled="disabled" />
              <label for="all-day">終日</label>
            </p>
            <label>イベントタイプ</label>
              <ul>
                <?php foreach ($selectList['event'] as $key => $value) {
                        echo('<li class="eventlist">');
                        if ($value == reset($selectList['event'])) {
                          echo('<input type="radio" name="title" id="'.$key.'" value="'.$value.'" checked="checked"/>');
                        } else {
                          echo('<input type="radio" name="title" id="'.$key.'" value="'.$value.'" />');
                        }
                        echo('<label for="'.$key.'">'.$value.'</label></li>');
                      }
                ?>
              </ul>
            </div>
          </div>
          <li class="search col s12 m6 l6">
            <div class="input-field">
              <select id="time-start" name="time_start">
                <option value="" disabled selected>出勤時間を選択してください</option>
                <?php foreach ($selectList['time'] as $key => $value) {
                  echo('<option value="' .$value.'">'.$value.'</option>');
                  }?>
              </select>
            </div>
          </li>
          <li class="search col s12 m6 l6">
            <div class="input-field">
            <select id="time-end" name="time_end">
                <option value="" disabled selected>退勤時間を選択してください</option>
                <?php foreach ($selectList['time'] as $key => $value) {
                  echo('<option value="' .$value.'">'.$value.'</option>');
                  }?>
              </select>
            </div>
          </li>
          </form>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn-large createBtn" onclick="calendarBtn($('#modal-calendar'), 'create');return false;"><i class="material-icons right">search</i>登録</a>
      <a class="waves-effect waves-light btn-large updateBtn" onclick="calendarBtn($('#modal-calendar'), 'update');return false;"><i class="material-icons right">search</i>更新</a>
      <a class="waves-effect waves-light btn-large deleteBtn" onclick="calendarBtn($('#modal-calendar'), 'delete');return false;"><i class="material-icons right">search</i>削除</a>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">閉じる</a>
    </div>
  </div>