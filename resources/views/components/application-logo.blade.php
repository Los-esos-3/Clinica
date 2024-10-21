<style>
  a {
    text-decoration: none;
  }
.header-title { 
  font-family: 'Arial', sans-serif; 
  text-align: left; 
} 

.header-title .kaiser { 
  font-size: 20px; 
  font-weight: bold; 
  color: #fff; 
  text-transform: uppercase; 
  letter-spacing: 2px; 
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
  display: block; 
} 

.header-title .subtext { 
  font-size: 13px; 
  font-style: italic; 
  color: #fff; 
  margin-top: 4px; 
    display: block;
}
</style>

<a href="{{ route('welcome') }}">
  <div class="header-title"> 
      <span class="kaiser">KAISER</span> 
      <span class="subtext">Clínica de Salud</span> 
  </div> 
</a>