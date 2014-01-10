      <ol class="breadcrumb"><!-- breadcrumb -->
        <li><a href="#">Início</a></li>
        <li><a href="#">Gerenciar Membros</a></li>
        <li class="active">Cadastro de Membros</li>
      </ol><!-- /breadcrumb -->
      <h2>Cadastro de Membro</h2>
      <form role="form"><!-- form -->
        <div class="form-group col-md-12">
          <label for="nome">Nome do Membro</label>
          <input type="text" class="form-control" id="nome" placeholder="Nome do Membro" required="required">
        </div>
        <div class="form-group col-md-12">
          <label for="email">Email Pessoal</label>
          <input name="email" type="email" class="form-control col-md-12" id="email" placeholder="Entre com seu e-mail" required="required">
        </div>
        <div class="nascimento">
          <div class="form-group col-md-3">
            <label for="tipo">Tipo de Membro</label>
            <select name="tipo" id="tipo" class="form-control">
              <option selected="selected">Selecione</option>
              <option>Membro</option>
              <option>Visitante</option>
              <option>Parente</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo" class="form-control">
              <option selected="selected">Selecione</option>
              <option>Masculino</option>
              <option>Feminino</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="datanascimento">Data de Nascimento</label>
            <input id="datanascimento" name="datanascimento" class="form-control" value="03/08/1990">
          </div>
          <div class="form-group col-md-3">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control">
              <option>AC</option>
              <option>AL</option>
              <option>AM</option>
              <option>BA</option>
              <option>CE</option>
              <option>DF</option>
              <option>ES</option>
              <option>GO</option>
              <option>MA</option>
              <option>MG</option>
              <option>MS</option>
              <option>MT</option>
              <option>PA</option>
              <option>PB</option>
              <option>PE</option>
              <option>PI</option>
              <option>PR</option>
              <option>RJ</option>
              <option>RN</option>
              <option>RO</option>
              <option>RR</option>
              <option>RS</option>
              <option>SC</option>
              <option>SE</option>
              <option>SP</option>
              <option>TO</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="naturalidade">Naturalidade</label>
          <input id="naturalidade" name="naturalidade" class="form-control" placeholder="Ex: Brasileiro">
        </div>
        <div class="form-group col-md-6">
          <label for="estadocivil">Estado Civil</label>
          <select name="estadocivil" id="estadocivil" class="form-control">
            <option>Solteiro</option>
            <option>Casado</option>
            <option>Viuvo</option>
            <option>Desquitado</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="rg">RG</label>
          <input id="rg" name="rg" class="form-control" placeholder="00.000.000-0">
        </div>
        <div class="form-group col-md-3">
          <label for="cpf">CPF</label>
          <input id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00">
        </div>
        <div class="form-group col-md-6">
          <label for="fone">Telefone</label>
          <input id="fone" name="fone" class="form-control" placeholder="(00) 0000-0000">
        </div>
        <div class="form-group col-md-6">
          <label for="cel">Celular</label>
          <input id="cel" name="cel" class="form-control" placeholder="(00) 00000-0000">
        </div>
        <div class="form-group col-md-6">
          <label for="escolaridade">Escolaridade</label>
          <select name="escolaridade" id="escolaridade" class="form-control">
            <option>Ensino Superior</option>
            <option>Ensino Médio Completo</option>
            <option>Ensino Médio Incompleto</option>
            <option>Ensino Fundamental Completo</option>
            <option>Ensino Fundamental Incompleto</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="profissao">Profissão</label>
          <input id="profissao" name="profissao" class="form-control profissao">
        </div>
        <div class="form-group col-md-6">
          <label for="empresa">Empresa</label>
          <input id="empresa" name="empresa" class="form-control" placeholder="Nome da Empresa">
        </div>
        <div class="form-group col-md-6">
          <label for="databatismo">Data de Batismo</label>
          <input id="databatismo" name="databatismo" class="form-control" placeholder="00/00/0000">
        </div>
        <div class="form-group col-md-6">
          <label for="igrejabatismo">Igreja Batismo</label>
          <input id="igrejabatismo" name="igrejabatismo" class="form-control" placeholder="Nome da igreja que foi batizado">
        </div>
        <div class="form-group col-md-6">
          <label for="pastorbatismo">Pastor que Batizou</label>
          <input id="pastorbatismo" name="pastorbatismo" class="form-control" placeholder="Nome do Pastor que batizou">
        </div>
        <div class="form-group col-md-6">
          <label for="ultimaigreja">Ultima igreja que frequentou</label>
          <input id="ultimaigreja" name="ultimaigreja" class="form-control" placeholder="Nome da Igreja que frequentou">
        </div>
        <div class="form-group" style="padding: 0 1em;">
          <label for="igrejasanteriores">Igrejas que já frequentou</label>
          <textarea name="igrejasanteriores" id="igrejasanteriores" class="form-control" placeholder="Nome das igrejas que já frequentou (pulando linhas)"></textarea>
        </div>
        <div class="form-group col-md-12">
          <label for="cargoId">Cargo na igreja</label>
          <input id="cargoId" name="cargoId" class="form-control" placeholder="Cargo que tinha na igreja">
        </div>
        <div class="form-group col-md-6">
          <button type="submit" class="btn btn-primary">Cadastrar nova pessoa</button>
        </div>
      </form><!-- /form -->