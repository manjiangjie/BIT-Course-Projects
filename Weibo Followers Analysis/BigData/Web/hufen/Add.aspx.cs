using System;
using System.Data;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Text;
using Maticsoft.Common;
using LTP.Accounts.Bus;
namespace Maticsoft.Web.hufen
{
    public partial class Add : Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
                       
        }

        		protected void btnSave_Click(object sender, EventArgs e)
		{
			
			string strErr="";
			if(this.txtid.Text.Trim().Length==0)
			{
				strErr+="id不能为空！\\n";	
			}
			if(!PageValidate.IsNumber(txtdata_num.Text))
			{
				strErr+="data_num格式错误！\\n";	
			}
			if(this.txtids.Text.Trim().Length==0)
			{
				strErr+="ids不能为空！\\n";	
			}
			if(!PageValidate.IsNumber(txttotal.Text))
			{
				strErr+="total格式错误！\\n";	
			}

			if(strErr!="")
			{
				MessageBox.Show(this,strErr);
				return;
			}
			string id=this.txtid.Text;
			int data_num=int.Parse(this.txtdata_num.Text);
			string ids=this.txtids.Text;
			int total=int.Parse(this.txttotal.Text);

			Maticsoft.Model.hufen model=new Maticsoft.Model.hufen();
			model.id=id;
			model.data_num=data_num;
			model.ids=ids;
			model.total=total;

			Maticsoft.BLL.hufen bll=new Maticsoft.BLL.hufen();
			bll.Add(model);
			Maticsoft.Common.MessageBox.ShowAndRedirect(this,"保存成功！","add.aspx");

		}


        public void btnCancle_Click(object sender, EventArgs e)
        {
            Response.Redirect("list.aspx");
        }
    }
}
