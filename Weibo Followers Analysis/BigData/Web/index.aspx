<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="index.aspx.cs" Inherits="Maticsoft.Web.index" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<body>
    <form id="form1" runat="server" method="post">
       <input type="text" id="inid" name="inid" runat="server" /> 
        <input type="submit" value="submit">
       
    </form> 

    <asp:Repeater ID="Repeater1" runat="server" >
        <ItemTemplate>
        <input type="text" value="<%#Container.DataItem%>" readonly="readonly" /><br/>
        </ItemTemplate>
    </asp:Repeater>
</body>
</html>
