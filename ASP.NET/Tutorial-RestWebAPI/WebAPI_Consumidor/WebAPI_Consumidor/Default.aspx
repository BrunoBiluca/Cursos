<%@ Page Title="Home Page" Language="C#" MasterPageFile="~/Site.Master" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="WebAPI_Consumidor._Default" %>

<asp:Content ID="BodyContent" ContentPlaceHolderID="MainContent" runat="server">

    <br>

    <asp:TextBox ID="txtBuscaNome" runat="server"></asp:TextBox>
    <asp:Button ID="btnBuscaNome" runat="server" Text="Buscar" OnClick="cmdBuscarNome_Click" />

    <br>

    <asp:GridView ID="GridView1" runat="server" AutoGenerateColumns="false" OnRowCommand="GridView1_RowCommand" DataKeyNames="id" >
        <Columns>
            <asp:BoundField DataField="id" HeaderText="Id" />
            <asp:BoundField DataField="nome" HeaderText="Nome" />
            <asp:ButtonField ButtonType="Link" CommandName="Excluir" Text="Excluir" HeaderText="Excluir" />
            <asp:ButtonField ButtonType="Link" CommandName="Atualizar" Text="Atualizar" HeaderText="Atualizar" />
        </Columns>
    </asp:GridView>

    <br>

    <asp:HiddenField ID="hdId" runat="server" />
    <asp:TextBox ID="txtNome" runat="server"></asp:TextBox>

    <asp:Button ID="cmdAtualizar" runat="server" Text="Atualizar" OnClick="cmdAtualizar_Click" />

</asp:Content>
