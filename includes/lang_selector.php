<div class="langdiv" style=" height:22px; overflow:visible;">
  <select id="langSelector" name="locale" style="overflow:visible; margin-bottom:1px;" onchange="window.location='?locale='+this.options[this.selectedIndex].value;">
    <option value="en_US" <?php echo $_SESSION['locale'] == 'en_US' ? "selected='selected'" : "" ?>>English</option>
    <option value="es_ES" <?php echo $_SESSION['locale'] == 'es_ES' ? "selected='selected'" : "" ?>>Espanol</option>
    <option value="fr_FR" <?php echo $_SESSION['locale'] == 'fr_FR' ? "selected='selected'" : "" ?>>French</option>
  </select>
</div>
