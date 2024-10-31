<div class="sidebar branding-below">
  <header class="resc-head">
    <div class="logo">
      <span class="img">
        <img width="48" height="48" src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'lib/images/Reescribir_icon_48_48.png' ?>" alt="logo" />
      </span>
      <span>Reescribir Textos</span>
    </div>
  </header>
  <div class="block form-group">
    <div id="za__form">
      <p class="original_text_l">Texto Original</p>
      <div class="input__area">
        <textarea placeholder="Escriba aquí..." spellcheck="false" id="translated-text" class="textarea_style" rows="10"></textarea>
        <div id="loader_img">
          <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . './lib/images/loader2.gif' ?>" alt="loader" />
        </div>
      </div>
      <div id="errorDiv" class="errorDiv">
        &#x26A0; <span id="errorSpan">This is an error!! You can test</span>
      </div>
      <div class="language_word_count">
        <div>
          <span class="wordCountColor">(<span id="wordCount1">0</span>
            <span class="wordCountColor">Palabras)</span></span>
        </div>
        <button id="run-translation" class="translate_btn">Rewrite</button>
      </div>
    </div>

    <div id="za__results">
      <p for="" class="result rewrite_text_l">Reescribir Textos</p>

      <div class="input__area">


        <div class="textarea_style result" id="result" rows="10" spellcheck="false">
          <span>El resultado estará aquí</span>
        </div>
        <div class="result__footer">
          <span class="wordCountColor">(<span id="wordCount2">0</span>
            <span class="wordCountColor">Palabras)</span></span>
          <div class="result__btn">
            <button id="copyBtn" class="insert_btn tooltip" data-title="Copiar texto">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#8172d5" d="M224 0c-35.3 0-64 28.7-64 64V288c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H224zM64 160c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H288c35.3 0 64-28.7 64-64V384H288v64H64V224h64V160H64z" />
              </svg>
            </button>
            <span id="copiedDataTitle" style="display: none">Copiada</span>
            <span id="copyDataTitle" style="display: none">Copiar texto</span>
          </div>
        </div>
      </div>

      <button id="cancel-text" data-title="Reset" class="cancel_btn">
        Reiniciar
      </button>
    </div>
  </div>

</div>
<div id="button-bar">
      <input type="hidden" id="zaChangeIndex" value="0" />
      <span id="tooltip" class="tooltip__main"> </span>
</div>