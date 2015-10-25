using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Runtime.InteropServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;
using System.Diagnostics;
using System.Threading;
using System.Net;

namespace WeiboFollowersAnalysis
{
    public partial class Form1 : Form
    {
        [DllImport("Project1.dll")]
        public static extern int getProgressPercent1();
        [DllImport("Project1.dll")]
        public static extern int getProgressPercent2();
        [DllImport("Project1.dll")]
        public static extern void getFollowers(char[] id, char[] srcJsonPath, char[] dstJsonPath, int srcJsonCountOfId);
        [DllImport("Project1.dll")]
        public static extern void analyseFollowersFocus(char[] followersOfOneIdJsonPath, char[] txtFilePath, int deadlineNum);
        static char[] id, srcJsonPath, dstJsonPath;
        static bool isRunning;
        public static void getFollowers(object o)
        {
            isRunning = true;
            getFollowers(id, srcJsonPath, dstJsonPath, 756503);
            isRunning = false;
            MessageBox.Show("成功将粉丝列表数据保存到" + new string(dstJsonPath) + "。", "提示", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }
        static char[] followersOfOneIdJsonPath, txtFilePath;
        static int deadlineNum, webGetProgress;
        static bool webGet;
        static string access_token;
        public static string webGetBigVInfo(string uid)
        {
            try
            {
                string urls = "https://api.weibo.com/2/users/show.json";
                urls += "?access_token=" + access_token;
                urls += "&uid=" + uid;
                WebRequest wrq;
                WebResponse wrp;
                wrq = HttpWebRequest.Create(urls);
                wrp = wrq.GetResponse();
                Stream resStream = wrp.GetResponseStream();
                StreamReader sr = new StreamReader(resStream, System.Text.Encoding.UTF8);
                string tempstr = sr.ReadToEnd();
                return tempstr;
            }
            catch (Exception exp)
            {
                MessageBox.Show(exp.Message, "错误", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return "";
            }
        }
        public static void analyseFollowersFocus(object o)
        {
            isRunning = true;
            analyseFollowersFocus(followersOfOneIdJsonPath, txtFilePath, deadlineNum);
            if (webGet)
            {
                string[] str = File.ReadAllLines(new string(txtFilePath),Encoding.Default);
                str[0] += "\t昵称";
                webGetProgress = 0;
                for (int i = 2; i <= 31; i++)
                {
                    int ipos=str[i].IndexOf('\t')+1;
                    string tmpstr = webGetBigVInfo(str[i].Substring(ipos, str[i].LastIndexOf('\t') - ipos));
                    if (tmpstr=="")
                    {
                        break;
                    }
                    else
                    {
                        ipos = tmpstr.IndexOf("screen_name") + 14;
                        str[i] += "\t" + tmpstr.Substring(ipos, tmpstr.IndexOf('\"', ipos + 1) - ipos);
                    }
                    webGetProgress += 10;
                }
                File.WriteAllLines(new string(txtFilePath), str, Encoding.Default);
            }
            MessageBox.Show("成功将粉丝关注的大V列表保存到" + new string(txtFilePath) + "。", "提示", MessageBoxButtons.OK, MessageBoxIcon.Information);
            isRunning = false;
        }
        public Form1()
        {
            InitializeComponent();
            isRunning = false;
        }
        
        private void button3_Click(object sender, EventArgs e)
        {
            if (isRunning)
            {
                MessageBox.Show("正在进行另一项工作，请等待其完成！", "提示", MessageBoxButtons.OK, MessageBoxIcon.Information);
                return;
            }
            this.Cursor = Cursors.WaitCursor;
            button3.Enabled = false;
            try
            {
                progressBar1.Value = 0;
                progressBar1.Show();
                id = textBoxWeiboId.Text.ToCharArray();
                srcJsonPath = textBoxSrcJsonPath.Text.ToCharArray();
                dstJsonPath = textBoxDstJsonPath.Text.ToCharArray();
                Thread th = new Thread(getFollowers);
                th.Name = "getFollowers";
                th.Start();
                timer1.Start();
            }
            catch (Exception exp)
            {
                MessageBox.Show(exp.Message, "错误", MessageBoxButtons.OK, MessageBoxIcon.Error);
                this.Cursor = Cursors.Default;
                timer1.Stop();
                button3.Enabled = true;
                progressBar1.Hide();
            }
        }

        private void button6_Click(object sender, EventArgs e)
        {
            if (isRunning)
            {
                MessageBox.Show("正在进行另一项工作，请等待其完成！", "提示", MessageBoxButtons.OK, MessageBoxIcon.Information);
                return;
            }
            if (checkBox1.Checked)
            {
                webGet = true;
                access_token = textBoxAccessToken.Text;
                progressBar2.Maximum = 1300;
            }
            else
            {
                webGet = false;
                progressBar2.Maximum = 1000;
            }
            this.Cursor = Cursors.WaitCursor;
            button6.Enabled = false;
            try
            {
                progressBar2.Value = 0;
                progressBar2.Show();
                followersOfOneIdJsonPath = textBoxFollowersOfOneIdJsonPath.Text.ToCharArray();
                txtFilePath = textBoxTxtFilePath.Text.ToCharArray();
                deadlineNum = int.Parse(textBoxDeadlineNum.Text);
                Thread th = new Thread(analyseFollowersFocus);
                th.Start();
                timer2.Start();
            }
            catch (Exception exp)
            {
                MessageBox.Show(exp.Message, "错误", MessageBoxButtons.OK, MessageBoxIcon.Error);
                this.Cursor = Cursors.Default;
                timer2.Stop();
                button6.Enabled = true;
                progressBar2.Hide();
            }
        }
        private void tabPage1_Click(object sender, EventArgs e)
        {

        }

        private void Form1_Load(object sender, EventArgs e)
        {

        }

        private void tabPage2_Click(object sender, EventArgs e)
        {

        }

        private void label7_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (openFileDialog.ShowDialog() == DialogResult.OK)
            {
                textBoxSrcJsonPath.Text = openFileDialog.FileName;
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (saveFileDialog.ShowDialog() == DialogResult.OK)
            {
                textBoxDstJsonPath.Text = saveFileDialog.FileName;
            }
        }

        private void textBoxWeiboId_TextChanged(object sender, EventArgs e)
        {
            if (textBoxWeiboId.Text != "" && textBoxSrcJsonPath.Text != "")
            {
                int index = textBoxSrcJsonPath.Text.LastIndexOf('\\');
                if (index > 0)
                {
                    textBoxDstJsonPath.Text = textBoxSrcJsonPath.Text.Substring(0, index + 1) + "followersList_" + textBoxWeiboId.Text + ".json";
                }
                else
                {
                    textBoxDstJsonPath.Text = textBoxSrcJsonPath.Text + "\\" + "followersList_" + textBoxWeiboId.Text + ".json";
                }
            }
        }

        private void textBoxWeiboId_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (!(Char.IsNumber(e.KeyChar)) && e.KeyChar != (Char)8)
            {
                e.Handled = true;
            } 
        }

        private void textBoxSrcJsonPath_TextChanged(object sender, EventArgs e)
        {
            if (textBoxWeiboId.Text != "" && textBoxSrcJsonPath.Text != "")
            {
                int index = textBoxSrcJsonPath.Text.LastIndexOf('\\');
                if (index > 0)
                {
                    textBoxDstJsonPath.Text = textBoxSrcJsonPath.Text.Substring(0, index + 1) + "followersList_" + textBoxWeiboId.Text + ".json";
                }
                else
                {
                    textBoxDstJsonPath.Text = textBoxSrcJsonPath.Text + "\\" + "followersList_" + textBoxWeiboId.Text + ".json";
                }
            }
        }

        private void textBoxDstJsonPath_TextChanged(object sender, EventArgs e)
        {
            textBoxFollowersOfOneIdJsonPath.Text = textBoxDstJsonPath.Text;
        }

        private void textBoxFollowersOfOneIdJsonPath_TextChanged(object sender, EventArgs e)
        {
            int index = textBoxFollowersOfOneIdJsonPath.Text.LastIndexOf('\\');
            if (index > 0)
            {
                textBoxTxtFilePath.Text = textBoxFollowersOfOneIdJsonPath.Text.Substring(0, index + 1) + "followersFocus_" + textBoxWeiboId.Text + ".txt";
            }
            else
            {
                textBoxTxtFilePath.Text = textBoxSrcJsonPath.Text + "\\" + "followersFocus_" + textBoxWeiboId.Text + ".txt";
            }
        }


        private void timer1_Tick(object sender, EventArgs e)
        {
            try
            {
                progressBar1.Value = getProgressPercent1();
            }
            catch (Exception exp)
            {
                MessageBox.Show(exp.ToString());
            }
            if (isRunning == false)
            {
                timer1.Stop();
                button3.Enabled = true;
                progressBar1.Hide();
                this.Cursor = Cursors.Default;
            }
        }

        private void timer2_Tick(object sender, EventArgs e)
        {
            if (webGet)
            {
                progressBar2.Value = getProgressPercent2() + webGetProgress;
            }
            else
            {
                progressBar2.Value = getProgressPercent2();
            }
            if (isRunning == false)
            {
                timer2.Stop();
                button6.Enabled = true;
                progressBar2.Hide();
                this.Cursor = Cursors.Default;
            }
        }

        private void checkBox1_CheckedChanged(object sender, EventArgs e)
        {
            if (checkBox1.Checked)
            {
                label8.Enabled = true;
                textBoxAccessToken.Enabled = true;
            }
            else
            {
                label8.Enabled = false;
                textBoxAccessToken.Enabled = false;
            }
        }

        private void Form1_FormClosing(object sender, FormClosingEventArgs e)
        {

        }

        private void button4_Click(object sender, EventArgs e)
        {
            if (openFileDialog.ShowDialog() == DialogResult.OK)
            {
                textBoxFollowersOfOneIdJsonPath.Text = openFileDialog.FileName;
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            if (saveFileDialog.ShowDialog() == DialogResult.OK)
            {
                textBoxDstJsonPath.Text = saveFileDialog.FileName;
            }
        }
    }
}



/*2.00vk2O7Cz4C_lD10c4de30aezwYDBE*/