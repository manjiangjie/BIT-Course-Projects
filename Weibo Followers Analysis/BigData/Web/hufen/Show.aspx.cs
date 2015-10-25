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
namespace Maticsoft.Web.hufen
{
    public partial class Show : Page
    {        
        		public string strid=""; 
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
		this.lblids.Text=model.ids;
		this.lbltotal.Text=model.total.ToString();

	}


    }
}
