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
    public partial class Modify : Page
    {       

        		protected void Page_Load(object sender, EventArgs e)
		{
			if (!Page.IsPostBack)
			{
				string id = "";
				if (Request.Params["id0"] != null && Request.Params["id0"].Trim() != "")
				{
					id= Request.Params["id0"];
				}
				int data_num = -1;
				if (Request.Params["id1"] != null && Request.Params["id1"].Trim() != "")
				{
					data_num=(Convert.ToInt32(Request.Params["id1"]));
				}
				#warning 代码生成提示：显示页面,请检查确认该语句是否正确
				ShowInfo(id,data_num);
			}
		}
			
	private void ShowInfo(string id,int data_num)
	{
		Maticsoft.BLL.hufen bll=new Maticsoft.BLL.hufen();
		Maticsoft.Model.hufen model=bll.GetModel(id,data_num);
		this.lblid.Text=model.id;
		this.lbldata_num.Text=model.data_num.ToString();
		this.txtids.Text=model.ids;
		this.txttotal.Text=model.total.ToString();

	}

		public void btnSave_Click(object sender, EventArgs e)
		{
			
			string strErr="";
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
			string id=this.lblid.Text;
			int data_num=int.Parse(this.lbldata_num.Text);
			string ids=this.txtids.Text;
			int total=int.Parse(this.txttotal.Text);


			Maticsoft.Model.hufen model=new Maticsoft.Model.hufen();
			model.id=id;
			model.data_num=data_num;
			model.ids=ids;
			model.total=total;

			Maticsoft.BLL.hufen bll=new Maticsoft.BLL.hufen();
			bll.Update(model);
			Maticsoft.Common.MessageBox.ShowAndRedirect(this,"保存成功！","list.aspx");

		}


        public void btnCancle_Click(object sender, EventArgs e)
        {
            Response.Redirect("list.aspx");
        }
    }
}
