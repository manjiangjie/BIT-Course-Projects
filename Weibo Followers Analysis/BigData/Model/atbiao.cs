using System;
namespace Maticsoft.Model
{
	/// <summary>
	/// atbiao:实体类(属性说明自动提取数据库字段的描述信息)
	/// </summary>
	[Serializable]
	public partial class atbiao
	{
		public atbiao()
		{}
		#region Model
		private string _id;
		private int _data_num;
		private string _ids;
		private int? _total;
		/// <summary>
		/// 
		/// </summary>
		public string id
		{
			set{ _id=value;}
			get{return _id;}
		}
		/// <summary>
		/// 
		/// </summary>
		public int data_num
		{
			set{ _data_num=value;}
			get{return _data_num;}
		}
		/// <summary>
		/// 
		/// </summary>
		public string ids
		{
			set{ _ids=value;}
			get{return _ids;}
		}
		/// <summary>
		/// 
		/// </summary>
		public int? total
		{
			set{ _total=value;}
			get{return _total;}
		}
		#endregion Model

	}
}

